import * as path from 'path';
import {v4 as uuid} from 'uuid';
import axios from 'axios';

export class ScreenCoordinates {
    public x: number;
    public y: number;

    public set(x: number, y: number): void {
        this.x = x || 0;
        this.y = y || 0;
    }

    constructor(x?: number, y?: number) {
        this.x = x || 0;
        this.y = y || 0;
    }
}

export type RawData = {
    image: string | undefined; ///< The webcam snapshot as a data URI.
    timestamp: number; ///< The timestamp
    url: string; ///< The visited URL
    mouse: { ///< Various data regarding the mouse
        position: ScreenCoordinates; ///< The mouse position. p[0] is the X position, p[1] is the Y position.
        buttons: Array<number>; ///< The mouse buttons (as integer codes)
    };
    scroll: { ///< Various data about the scroll position
        absolute: ScreenCoordinates; ///< The absolute scroll position. a[0] is the X position, a[1] is the Y position.
        relative: ScreenCoordinates; ///< The relative scroll position (from the bottom of the screen). r[0] is the X position, r[1] is the Y position.
    };
    window: {
        screen: ScreenCoordinates, ///< Various data about the browser's window. w[0] is the width, w[1] is the height.
        document: ScreenCoordinates, ///< Various data about the browser's document. w[0] is the width, w[1] is the height.
    };
    keyboard: Array<string>; ///< An array of keys that's currently pressed
}
export type CollectedData = {
    userId: string; ///< The user ID
    timestamp: number; ///< The timestamp
    url: string; ///< The visited URL
    mouse: { ///< Various data regarding the mouse
        position: ScreenCoordinates; ///< The mouse position.
        buttons: { ///< The mouse buttons
            left: boolean; ///< Is the left button pressed?
            middle: boolean; ///< Is the middle button pressed?
            right: boolean; ///< Is the right button pressed?
            [key: string]: boolean; ///< Are other buttons pressed?
        };
    };
    scroll: { ///< Various data about the scroll position
        absolute: ScreenCoordinates; ///< The absolute scroll position.
        relative: ScreenCoordinates; ///< The relative scroll position (from the bottom of the screen).
    };
    window: ScreenCoordinates; ///< Various data about the browser's window. w[0] is the width, w[1] is the height.
    keyboard: { ///< An array of keys that's currently pressed
        alpha: boolean; ///< Is a alphabetic key pressed?
        numeric: boolean; ///< Is a numeric key pressed?
        symbol: boolean; ///< Is a symbol key pressed?
        function: boolean; ///< Is a function key pressed?
    };
    image: string; ///< The webcam snapshot as a data URI.
}

const IDENTIFIER = "%IDENTIFIER%";
//const UXSAD_URL_CHECK_API = "%UXSAD_URL_CHECK_API%";
const REAL_URL = new URL("%REAL_URL%");
const API_ENDPOINT = "%API_ENDPOINT%";
const SENDING_INTERVAL = 5; // in seconds
const toSend: Array<Object> = [];

if (!window.localStorage.getItem("sid")) {
    console.log("you don't have a user id. I'm generating one...");
    window.localStorage.setItem("sid", uuid());
}

function checkUrl(): boolean {
    const thisUrl = new URL(window.location.href);
    const relative = path.relative(REAL_URL.pathname, thisUrl.pathname);
    return thisUrl.host === REAL_URL.host &&
        thisUrl.port === REAL_URL.port &&
        (relative === "" || !relative.startsWith('..') && !path.isAbsolute(relative));
}

let keyboard: Set<string> = new Set<string>();
let mousePosition: RawData["mouse"]["position"] = new ScreenCoordinates();
let mouseButtons: Set<number> = new Set<number>();

function relativeScroll(): RawData["scroll"]["relative"] {
    const height = document.body.offsetHeight;
    const width = document.body.offsetWidth;

    const absoluteY = window.pageYOffset;
    const absoluteX = window.pageXOffset;

    const relativeY = 100 * (absoluteY + document.documentElement.clientHeight) / height;
    const relativeX = 100 * (absoluteX + document.documentElement.clientWidth) / width;
    return new ScreenCoordinates(relativeX, relativeY);
}

function sendCollectionRequest(): void {
    const objectToSend: RawData = {
        image: undefined,
        keyboard: Array.from(keyboard),
        mouse: {
            buttons: Array.from(mouseButtons),
            position: mousePosition
        },
        scroll: {
            absolute: new ScreenCoordinates(window.pageXOffset, window.pageYOffset),
            relative: relativeScroll()
        },
        timestamp: Date.now(),
        url: window.location.href,
        window: {
            screen: new ScreenCoordinates(window.innerWidth, window.outerHeight),
            document: new ScreenCoordinates(document.documentElement.offsetWidth, document.documentElement.offsetHeight)
        }
    };
    messageCollected(objectToSend);
}

if (checkUrl()) {
    document.body.innerHTML += "<p style='color:red; text-align:center;'>Execute script here!</p>";
    window.addEventListener("mousedown", (e: MouseEvent) => {
        mouseButtons.add(e.button);
        sendCollectionRequest();
    });
    window.addEventListener("mouseup", (e: MouseEvent) => {
        mouseButtons.delete(e.button);
        sendCollectionRequest();
    });
    window.addEventListener("mousemove", e => {
        mousePosition.set(e.pageX, e.pageY);
        sendCollectionRequest();
    });
    window.addEventListener("keydown", (e: KeyboardEvent) => {
        keyboard.add(e.key);
        sendCollectionRequest();
    });
    window.addEventListener("keyup", (e: KeyboardEvent) => {
        if (!keyboard.delete(e.key)) {
            // Error fix: released a key that was pressed
            // Example: the key '[' emits as '[' on press and 'è' on release on Chrome
            keyboard.clear();
        }
        sendCollectionRequest();
    });
    window.addEventListener("scroll", (e: Event) => {
        if (e.target == window || e.target == document) {
            //this.relativeScroll.set(window.pageXOffset, window.pageYOffset);
            sendCollectionRequest();
        }
    });
    window.addEventListener("resize", (e: UIEvent) => {
        if (e.target == window) {
            sendCollectionRequest();
        }
    });

    setInterval(sendData, SENDING_INTERVAL * 1000);
}

function messageCollected(obj: any) {
    toSend.push({
        ...obj,
        userId: window.localStorage.getItem("sid"),
        websiteId: IDENTIFIER,
        pageTitle: document.title
    });
    console.log("collected", toSend);
}

async function sendData() {
    if (toSend.length === 0) {
        console.log("nothing to do");
        return;
    }

    try {
        const results = await axios.post(API_ENDPOINT, {'data': toSend});
        toSend.length = 0;
        console.warn("done", results);
    } catch (error) {
        console.error(error);
        console.log(error.response);
    }
}
