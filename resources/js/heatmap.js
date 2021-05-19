import Plotly from 'plotly.js-dist';

window.Plotly = Plotly;

window.Heatmap = class {
    constructor(containerId, yVal, xVal, emotionValues, imageUrl) {
        this.container = document.getElementById(containerId);
        this.x = xVal;
        this.y = yVal;
        this.emotionValues = emotionValues;
        this.imageUrl = imageUrl;
    }

    draw(emotion) {
        const plotScaleWidth = 60;
        const img = new Image();
        img.src = this.imageUrl;
        img.onload = () => {
            const z = this.emotionValues[emotion];
            const finalZ = this.y.map(yval => this.x.map(xval => {
                let el = z.find(zval => zval['x'] === xval && zval['y'] === yval)
                return el === undefined ? null : el['emotion'];
            }));
            const data = [{
                z: finalZ,
                y: y,
                x: x,
                colorscale: 'Jet',
                contours: {
                    coloring: 'heatmap',
                    start: 0,
                    end: 2,
                    size: 0.25
                },
                line: {
                    smoothing: 0.85
                },
                colorbar: {
                    thickness: plotScaleWidth,
                    thicknessmode: 'pixels',
                    len: 0.5,
                    lenmode: 'fraction',
                    outlinewidth: 0
                },
                zsmooth: 'best',
                type: 'contour',
                opacity: 0.75,
                connectgaps: true,
            }];

            function getFinalHeight(imageW, imageH, containerW) {
                return imageH * containerW / imageW;
            }

            const layout = {
                xaxis: {range: [0, 100]},
                yaxis: {range: [100, 0]},
                width: this.container.clientWidth,
                height: getFinalHeight(img.width, img.height, this.container.clientWidth - plotScaleWidth),
                margin: {l: 0, r: 0, b: 0, t: 0, pad: 0},
                images: [
                    {
                        source: img.src,
                        xref: "paper",
                        yref: "paper",
                        x: 0,
                        y: 0,
                        layer: "below",
                        sizing: "stretch",
                        sizex: 1,
                        sizey: 1,
                        xanchor: "left",
                        yanchor: "bottom"
                    }
                ]
            }
            Plotly.newPlot('heatmap-container', data, layout, {staticPlot: true, responsive: true});
            Plotly.relayout(this.container.id, {
                width: this.container.clientWidth,
                height: getFinalHeight(img.width, img.height, this.container.clientWidth - plotScaleWidth)
            });


            window.addEventListener('resize', () => {
                Plotly.relayout(this.container.id, {
                    width: this.container.clientWidth,
                    height: getFinalHeight(img.width, img.height, this.container.clientWidth - plotScaleWidth)
                });
            });
        }
    }
}
