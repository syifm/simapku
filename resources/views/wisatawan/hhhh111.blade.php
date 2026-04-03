<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Range Slider</title>
    <link rel="stylesheet" href="style.css" />
    <script src="script.js" defer></script>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Jost:wght@400;500;600&display=swap");

        * {
            font-family: "Jost", sans-serif;
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        :root {
            --blue-color: #357ded;
            --gray-color: #77889926;
        }

        body {
            background: var(--blue-color);
            display: flex;
            align-items: center;
            flex-direction: column;
            min-height: 100dvh;
        }

        .container {
            margin-block: auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            width: min(480px, 90%);
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.25);
        }

        .container h3 {
            font-size: 2rem;
        }

        /* range slider styles */

        .range-slider {
            display: flex;
            flex-wrap: wrap;
            align-items: flex-start;
            justify-content: space-between;
            gap: 20px;
            padding-block: 20px;
        }

        .range-slider.dragging {
            cursor: ew-resize;
        }

        .range-slider>input {
            border: none;
            outline: none;
            background: var(--gray-color);
            font-size: 1.5rem;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            min-width: 64px;
        }

        .range {
            width: 100%;
            display: grid;
            position: relative;
            z-index: 5;
        }

        .range input {
            grid-row: 2;
            grid-column: 1;
            pointer-events: none;
            appearance: none;
            background: transparent;
        }

        .range input::-webkit-slider-thumb {
            pointer-events: auto;
            appearance: none;
            width: 30px;
            height: 30px;
            background: var(--blue-color);
            border-radius: 50%;
            cursor: pointer;
        }

        .slider {
            position: absolute;
            height: 10px;
            width: 100%;
            background: var(--gray-color);
            top: 50%;
            transform: translateY(-50%);
            border-radius: 5px;
            overflow: hidden;
            z-index: -1;
        }

        .progress {
            position: absolute;
            height: 100%;
            background: var(--blue-color);
            cursor: ew-resize;
        }
    </style>
    {{-- <!-- social links for refinedguides.com -->
    <script src="https://refinedguides.com/assets/social.js?linkColor=%23fff&textColor=%23000" defer></script> --}}
</head>

<body>
    <div class="container">
        <h3>Filter by Price</h3>

        <!-- .range-slider -->
        <div class="range-slider">
            <input type="number" class="min-price" value="25" min="1" max="100" />
            <input type="number" class="max-price" value="75" min="1" max="100" />

            <!-- .range -->
            <div class="range">
                <input type="range" class="min-input" value="25" min="1" max="100" />
                <input type="range" class="max-input" value="75" min="1" max="100" />

                <!-- .slider -->
                <div class="slider">
                    <div class="progress"></div>
                </div>
                <!-- /.slider -->
            </div>
            <!-- /.range -->
        </div>
        <!-- /.range-slider -->
    </div>

    <script>
        const slider = document.querySelector(".range-slider");
        const progress = slider.querySelector(".progress");
        const minPriceInput = slider.querySelector(".min-price");
        const maxPriceInput = slider.querySelector(".max-price");
        const minInput = slider.querySelector(".min-input");
        const maxInput = slider.querySelector(".max-input");

        const updateProgress = () => {
            const minValue = parseInt(minInput.value);
            const maxValue = parseInt(maxInput.value);

            // get the total range of the slider
            const range = maxInput.max - minInput.min;
            // get the selected value range of the progress
            const valueRange = maxValue - minValue;
            // calculate the width percentage
            const width = (valueRange / range) * 100;
            // calculate the min thumb offset
            const minOffset = ((minValue - minInput.min) / range) * 100;

            // update the progress width
            progress.style.width = width + "%";
            // update the progress left position
            progress.style.left = minOffset + "%";

            // update the number inputs
            minPriceInput.value = minValue;
            maxPriceInput.value = maxValue;
        };

        const updateRange = (event) => {
            const input = event.target;

            let min = parseInt(minPriceInput.value);
            let max = parseInt(maxPriceInput.value);

            if (input === minPriceInput && min > max) {
                max = min;
                maxPriceInput.value = max;
            } else if (input === maxPriceInput && max < min) {
                min = max;
                minPriceInput.value = min;
            }

            minInput.value = min;
            maxInput.value = max;

            updateProgress();
        };

        minPriceInput.addEventListener("input", updateRange);
        maxPriceInput.addEventListener("input", updateRange);

        minInput.addEventListener("input", () => {
            if (parseInt(minInput.value) >= parseInt(maxInput.value)) {
                maxInput.value = minInput.value;
            }
            updateProgress();
        });

        maxInput.addEventListener("input", () => {
            if (parseInt(maxInput.value) <= parseInt(minInput.value)) {
                minInput.value = maxInput.value;
            }
            updateProgress();
        });

        let isDragging = false;
        let startOffsetX;

        progress.addEventListener("mousedown", (e) => {
            e.preventDefault(); // prevent text selection

            isDragging = true;

            startOffsetX = e.clientX - progress.getBoundingClientRect().left;

            slider.classList.toggle("dragging", isDragging);
        });

        document.addEventListener("mousemove", (e) => {
            if (isDragging) {
                // get the size and position of the slider
                const sliderRect = slider.getBoundingClientRect();
                const progressWidth = parseFloat(progress.style.width || 0);

                // calculate the new left position for the progress element
                let newLeft =
                    ((e.clientX - sliderRect.left - startOffsetX) / sliderRect.width) * 100;

                // ensure the progress is not exceeding the slider boundaries
                newLeft = Math.min(Math.max(newLeft, 0), 100 - progressWidth);

                // update the progress position
                progress.style.left = newLeft + "%";

                // calculate the new min thumb position
                const range = maxInput.max - minInput.min;
                const newMin = Math.round((newLeft / 100) * range) + parseInt(minInput.min);
                const newMax = newMin + parseInt(maxInput.value) - parseInt(minInput.value);

                // update the min input
                minInput.value = newMin;
                maxInput.value = newMax;

                // update the progress
                updateProgress();
            }
            slider.classList.toggle("dragging", isDragging);
        });

        document.addEventListener("mouseup", () => {
            if (isDragging) {
                isDragging = false;
            }
            slider.classList.toggle("dragging", isDragging);
        });

        updateProgress();
    </script>
</body>

</html>
