import simpleheat from "simpleheat";

window.simpleheat = simpleheat;

window.initializeHeatmap = function (containerId, imageUrl) {
    const container = document.getElementById(containerId);
    const image = document.createElement("img");
    // TODO: Set size based on image
    image.width = 1920;
    image.height = 939;
    image.className = "absolute top-0 w-full h-full";
    image.src = imageUrl;
    container.appendChild(image);
    const canvas = document.createElement("canvas");
    // TODO: Set size based on image
    canvas.width = 1920;
    canvas.height = 939;
    canvas.className = "absolute top-0 h-full w-full";
    canvas.style.opacity = "0.75";
    container.appendChild(canvas);
    return simpleheat(canvas)
        .max(3)
        .radius(50, 50)
        .gradient({
            0.4: 'blue',
            0.6: 'cyan',
            0.7: 'lime',
            0.8: 'yellow',
            1.0: 'red'
        });
}
