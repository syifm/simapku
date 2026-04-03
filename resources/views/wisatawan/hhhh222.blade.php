<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            display: flex;
            align-items: flex-start;
            gap: 20px;
        }

        .custome-select {
            position: relative;
            width: 500px;
        }

        .select-box {
            background-color: #ffffff;
            border: 1px solid #ced4da;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 56px;
            padding: 0 10px;
            cursor: pointer;
        }

        .selected-options {
            display: flex;
            flex-wrap: wrap;
            margin-top: 0;
        }

        .tag {
            background-color: #f2f2f2;
            color: #000;
            border-radius: 5px;
            margin-right: 5px;
            padding: 6px 14px;
            display: flex;
            align-items: center;
        }

        .remove-tag {
            margin-left: 6px;
            cursor: pointer;
        }

        .arrow {
            margin: 0 10px;
        }

        .fa-angle-down {
            color: #404040;
            font-size: 30px;
        }

        .options {
            display: none;
            position: absolute;
            width: 100%;
            background-color: #ffffff;
            border: 1px solid #ced4da;
            border-top: none;
            max-height: 225px;
            overflow-y: auto;
            z-index: 1;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .open .options {
            display: block;
        }

        .option-search-tags {
            background-color: #ffffff;
            border: 1px solid #ced4da;
            padding: 8px 0px;
            margin: 8px;
        }

        .search-tags {
            width: 100%;
            border: none;
            outline: none;
            padding: 8px;
            font-size: 14px;
        }

        .clear {
            position: absolute;
            border: none;
            background-color: transparent;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            padding: 0;
            color: #000;
            top: 26px;
            left: auto;
            right: 15px;
        }

        .option {
            padding: 12px;
            cursor: pointer;
        }

        .option.active {
            color: #000;
            background-color: #f2f2f2;
            border-bottom: 1px solid #eaeaea;
        }

        .tag:hover,
        .option:hover {
            background-color: #eaeaea;
        }

        .no-result-message {
            padding: 0px 0px 12px 12px;
        }

        .error {
            color: #ff1a2a;
            margin-top: 8px;
        }

        .btn_submit {
            padding: 17px 24px;
            background-color: #4caf50;
            color: #ffffff;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

        .btn_submit:hover {
            background-color: #4caf50;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="custom-select">
            <div class="select box">
                <input type="text" class="tags_input" name="tags" hidden />
                <div class="selected-options">
                </div>
                <div class="arrow"><i class="fa fa-angle-down"></i></div>
            </div>
            <div class="options">
                <div class="option-search-tags">
                    <input type="text" class="search-tags" placeholder="Search tags...">
                    <button type="button" class="clear"><i class="fa fa-close"></i></button>
                </div>
                <div class="option all-tags" data-value="All">Select All</div>
                <div class="option" data-value="Black">Black</div>
                <div class="option" data-value="Green">Green</div>
                <div class="option" data-value="Green">Navy</div>
                <div class="option" data-value="Green">Orange</div>
                <div class="option" data-value="Green">Pink</div>
                <div class="option" data-value="Green">Red</div>
                <div class="option" data-value="Green">Silver</div>
                <div class="option" data-value="Green">White</div>
                <div class="option" data-value="Green">Yellow</div>
                <div class="no-result-message" style="display: none;">No result match</div>

            </div>
            <span class="tag_error_msg error"></span>

        </div>
        <input type="button" class="btn_submit" value="Submit" />
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const customSelects = document.querySelectorAll(".custom-select");

            function updateSelectedOptions(customSelect) {
                const selectedOptions = Array.from(customSelect.querySelectorAll(".option.active")).filter(option =>
                    option !== customSelect.querySelector(".option.all-tags")).map(function(option) {
                    return {
                        value: option.getAttribute("data-value"),
                        text: option.textContent.trim()
                    };
                });

                const selectedValues = selectedOptions.map(function(option) {
                    return option.value;
                })

                customSelect.querySelector(".tags_input").value = selectedValues.join(', ');

                let tagsHTML = "";

                if (selectedOptions.length === 0) {
                    tagsHTML = '<span class="placeholder">Select the tag</span>';
                } else {
                    const maxTagsToShow = 4;
                    let additionalTagsCount = 0;

                    selectedOptions.forEach(function(option, index) {
                        if (index < maxTagsToShow) {
                            tagsHTML += '<span class="tag">' + option.text +
                                '<span class="remove-tag" data-value"' + option.value +
                                '">&times;</span></span>';
                        } else {
                            additionalTagsCount++;
                        }
                    });

                    if (additionalTagsCount > 0) {
                        tagsHTML += '<span class="tag">+' + additionalTagsCount + '</span>';
                    }
                }
                customSelect.querySelector(".selected-options").innerHTML = tagsHTML;
            }

            customSelects.forEach(function(customSelect) {
                const searchInput = customSelect.querySelector(".search-tags");
                const optionsContainer = customSelect.querySelector(".no-result-message");
                const options = customSelect.querySelectorAll(".options");
                const allTagsOption = customSelect.querySelector(".option-all-tags");
                const clearButton = customSelect.querySelector(".clear");

                allTagsOption.addEventListener("click", function() {
                    const isActive = allTagsOption.classList.contains("active");

                    options.forEach(function(option) {
                        if (option !== allTagsOption) {
                            option.classList.toggle("active", !isActive);
                        }
                    });

                    updateSelectedOptions(customSelect);
                });

                clearButton.addEventListener("click", function() {
                    searchInput.value = "";
                    options.forEach(function(option) {
                        option.style.display = "block";
                    });
                    noResultMessage.style.display = "none";
                });

                searchInput.addEventListener("input", function() {
                    const searchTerm = searchInput.value.toLowerCase();

                    options.forEach(function(option) {
                        const optionText = option.textContent.trim().toLocaleLowerCase();
                        const shouldShow = optionText.includes(searchTerm);
                        option.style.display = shouldShow ? "block" : "none";
                    });

                    const anyOptionsMatch = Array.from(options).some(option => option.style
                        .display === "block");
                    noResultMessage.style.display = anyOptionsMatch ? "none" : "block";

                    if (searchTerm) {
                        optionsContainer.classList.add("option-search-active");
                    } else {
                        optionsContainer.classList.remove("option-search-active");
                    }
                })
            });

            customSelects.forEach(function(customSelect) {
                const options = customSelect.querySelectorAll(".option");
                options.forEach(function(option) {
                    option.addEventListener("click", function() {
                        option.classList.toggle("active");
                        updateSelectedOptions(customSelect);
                    });
                });
            });

            document.addEventListener("click", function(event) {
                const removeTag = event.target.closest(".remove-tag");
                if (removeTag) {
                    const customSelect = removeTag.closest(".custom-select");
                    const valueToRemove = removeTag.getAttribute("data-value");
                    const optionToRemove = customSelect.querySelector(".option[data-value='" +
                        valueToRemove + "']");
                    optionToRemove.classList.remove("active");

                    const otherSelectedOptions = customSelect.querySelectorAll(
                        ".option.active:not(.all-tags)");
                    const allTagsOption = customSelect.querySelector(".option.all-tags");

                    if (otherSelectedOptions.length === 0) {
                        allTagsOption.classList.remove("active");
                    }
                    updateSelectedOptions(customSelect);
                }
            });

            const selectBoxes = document.querySelectorAll(".select-box");
            selectBoxes.forEach(function(selectBox) {
                selectBox.addEventListener("click", function(event) {
                    if (!event.target.closest(".tag")) {
                        selectBox.parentNode.classList.toggle("open");
                    }
                });
            });

            document.addEventListener("click", function(event) {
                if (!event.target.closest(".custom-select") && !event.target.classList.contains(
                        "remove-tag")) {
                    customSelects.forEach(function(customSelect) {
                        customSelect.classList.remove("open");
                    });
                }
            });

            function resetCustomSelect() {
                customSelects.forEach(function(customSelect) {
                    customSelect.querySelectorAll(".option.active").forEach(function(option) {
                        option.classList.remove("active");
                    });
                    customSelect.querySelector(".option.all-tags").classList.remove("active");
                    updateSelectedOptions(customSelect);
                });
            }
            updateSelectedOptions(customSelects[0]);

            const submitButton = document.querySelector(".btn_submit");
            submitButton.addEventListener("click", function() {
                let valid = true;

                customSelects.forEach(function(customSelect) {
                    const selectedOptions = customSelect.querySelectorAll(".option.active");

                    if (selectedOptions.length === 0) {
                        const tagErrorMsg = customSelect.querySelector(".tag_error_msg");
                        tagErrorMsg.textContent = "This field is required";
                        tagErrorMsg.style.display = "block";
                        valid = false;
                    } else {
                        const tagErrorMsg = customSelect.querySelector(".tag_error_msg");
                        tagErrorMsg.textContent = "";
                        tagErrorMsg.style.display = "none";
                    }
                });

                if (valid) {
                    let tags = document.querySelector(".tags_input").value;
                    alert(tags);
                    resetCustomSelect();
                    return;
                }
            });

        });
    </script>
</body>

</html>
