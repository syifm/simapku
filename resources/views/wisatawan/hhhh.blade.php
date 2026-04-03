<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,minimum-scale=1">
    <title>Multi Select JS - Demos</title>
    <!-- Include the Multi Select stylesheet -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/multi-select-dropdown-js/MultiSelect.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-multiselect@0.9.13/dist/css/bootstrap-multiselect.css">
    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/3.0.0/uicons-bold-rounded/css/uicons-bold-rounded.css'>
    <style>
        * {
            box-sizing: border-box;
            font-family: system-ui, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            font-size: 16px;
        }

        body {
            margin: 0;
            padding: 20px;
            background-color: #f3f4f7;
            color: #212529;
        }

        .container {
            display: flex;
            flex-direction: column;
            margin: 60px auto;
            padding: 40px 50px 50px;
            max-width: 600px;
            width: 100%;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        h1 {
            margin: 0 0 5px;
            font-size: 28px;
            font-weight: 600;
            color: #212529;
        }

        p.description {
            color: #65727e;
            margin-top: 0;
            margin-bottom: 10px;
            font-size: 15px;
            line-height: 1.5;
        }

        label {
            display: block;
            margin: 20px 0 10px;
            font-weight: 600;
            color: #212529;
            padding-bottom: 8px;
        }

        .hint {
            display: block;
            font-size: 13px;
            color: #888;
            margin-top: 5px;
            margin-bottom: 5px;
            font-weight: normal;
        }

        .btn {
            display: inline-block;
            margin-top: 30px;
            padding: 14px 20px;
            background: #40c979;
            color: #fff;
            font-weight: bold;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.2s;
            width: 100%;
        }

        .btn:hover {
            background: #35b068;
        }

        .btn-small {
            width: auto;
            margin-top: 10px;
            font-size: 14px;
            padding: 8px 15px;
            background: #6c757d;
        }

        .btn-small:hover {
            background: #5a6268;
        }
    </style>
</head>

<body>

    {{-- <form class="container"
        onsubmit="event.preventDefault(); alert('Success! Form validation passed and data is ready to be submitted.');"> --}}

    {{-- <h1>Multi Select JS</h1> --}}
    {{-- <p class="description">A lightweight, dependency-free, and highly customizable Vanilla JavaScript library. Check
            out the interactive demos below.</p> --}}

    {{-- <!-- DEMO 1: OptGroups -->
        <label for="fruits">
            1. Standard & OptGroups
            <span class="hint">Parses standard HTML <code>&lt;optgroup&gt;</code> tags. Click a group header to toggle
                the entire sublist.</span>
        </label>
        <select id="fruits" name="fruits[]" data-placeholder="Select fruits" multiple data-multi-select>
            <optgroup label="Berries">
                <option value="Blackberry">Blackberry</option>
                <option value="Blueberry">Blueberry</option>
                <option value="Raspberry">Raspberry</option>
                <option value="Strawberry">Strawberry</option>
            </optgroup>
            <optgroup label="Citrus">
                <option value="Orange">Orange</option>
                <option value="Grapefruit">Grapefruit</option>
                <option value="Lemon">Lemon</option>
            </optgroup>
            <optgroup label="Other">
                <option value="Apple">Apple</option>
                <option value="Banana">Banana</option>
                <option value="Mango">Mango</option>
                <option value="Watermelon">Watermelon</option>
            </optgroup>
        </select> --}}

    <!-- DEMO 2: Validation & Limits -->
    {{-- <label for="cars">
            2. Limits & Form Validation
            <span class="hint">Try to submit the form without selecting a car. Uses <code>required</code>,
                <code>data-max="3"</code>, and hides the "Select All" button.</span>
        </label>
        <select id="cars" name="cars[]" data-placeholder="Select up to 3 cars (Required)" required data-max="3"
            data-select-all="false" multiple data-multi-select>
            <option value="Audi">Audi</option>
            <option value="BMW">BMW</option>
            <option value="Chevrolet">Chevrolet</option>
            <option value="Dodge">Dodge</option>
            <option value="Ford">Ford</option>
            <option value="Honda">Honda</option>
            <option value="Toyota">Toyota</option>
        </select> --}}

    <!-- DEMO 3: Dark Mode -->
    {{-- <label for="darkmode">
            3. Dark Mode Theme
            <span class="hint">Easily toggle themes using <code>data-theme="dark"</code> (Accepts: auto, light,
                dark).</span>
        </label> --}}
    <select id="darkmode" name="darkmode[]" data-placeholder="Dark mode active..." data-theme="dark" multiple
        data-multi-select>
        <option value="1">Dark Option 1</option>
        <option value="2">Dark Option 2</option>
        <option value="3">Dark Option 3</option>
        <option value="4">Dark Option 4</option>
        <option value="5">Dark Option 5</option>
        <option value="6">Dark Option 6</option>
    </select>

    <select id="minimal-multiselect" multiple="multiple">
        <option value="cheese">Cheese</option>
        <option value="tomatoes">Tomatoes</option>
        <option value="mozarella">Mozzarella</option>
        <option value="mushrooms">Mushrooms</option>
        <option value="pepperoni">Pepperoni</option>
        <option value="onions">Onions</option>
    </select>

    <!-- DEMO 4: Advanced JS Init -->
    {{-- <label for="dynamic">
            4. Advanced JS Initialization
            <span class="hint">Initialized entirely via JavaScript. Showcases HTML tag injection, custom callbacks,
                and auto-close on selection.</span>
        </label>
        <select id="dynamic" name="dynamic[]" multiple></select> --}}

    <!-- DEMO 5: Async Fetch -->
    {{-- <label for="async">
            5. Async Data Fetching
            <span class="hint">Natively fetch JSON arrays from remote endpoints.</span>
        </label>
        <select id="async" name="async[]" multiple></select>
        <button id="fetch-btn" type="button" class="btn btn-small">Fetch Remote Data</button> --}}


    <!-- Submit Button for Testing Form Validation -->
    {{-- <button type="submit" class="btn">Test Form Submission</button> --}}

    {{-- </form> --}}

    <!-- Include the Multi Select JS class -->
    <script src="https://cdn.jsdelivr.net/npm/multi-select-dropdown-js/MultiSelect.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-multiselect@0.9.13/dist/js/bootstrap-multiselect.js"></script>
    <script>
        $(document).ready(function() {
            $('#minimal-multiselect').multiselect();
        });
    </script>
    <!-- Initialize Custom JS Demos -->
    <script>
        // ==========================================
        // DEMO 4: Advanced JS Configuration
        // ==========================================
        // const dynamicSelect = new MultiSelect('#dynamic', {
        //     placeholder: 'Select an option',
        //     search: true,
        //     selectAll: false,
        //     listAll: false, // Will show "X selected" instead of rendering tags
        //     closeListOnItemSelect: true, // Auto-closes dropdown on click
        //     data: [{
        //             value: 'opt1',
        //             text: 'Standard Option'
        //         },
        //         {
        //             value: 'opt2',
        //             html: '<span style="color: #e44e4e; font-weight: bold;">Option 2 with Custom HTML!</span>'
        //         },
        //         {
        //             value: 'opt3',
        //             text: 'Pre-Selected Option',
        //             selected: true
        //         },
        //         {
        //             value: 'opt4',
        //             text: 'Option 4'
        //         },
        //         {
        //             value: 'opt5',
        //             text: 'Option 5'
        //         }
        //     ],
        //     onChange: function(value, text, element) {
        //         console.log('Change Event:', value, text);
        //     },
        //     onSelect: function(value, text, element) {
        //         console.log('Selected Event:', value);
        //     },
        //     onUnselect: function(value, text, element) {
        //         console.log('Unselected Event:', value);
        //     }
        // });

        // // ==========================================
        // // DEMO 5: Async Fetch Data API
        // // ==========================================
        // const asyncSelect = new MultiSelect('#async', {
        //     placeholder: 'Click fetch button to load...',
        //     search: true,
        //     selectAll: true
        // });

        // document.getElementById('fetch-btn').addEventListener('click', async (e) => {
        //     const btn = e.target;
        //     btn.textContent = "Loading...";
        //     btn.disabled = true;

        //     // Mock an API Response to keep the demo self-contained
        //     const mockApiData = JSON.stringify([{
        //             value: 'remote_1',
        //             text: 'Cloud User 1',
        //             group: 'Fetched Data'
        //         },
        //         {
        //             value: 'remote_2',
        //             text: 'Cloud User 2',
        //             group: 'Fetched Data'
        //         },
        //         {
        //             value: 'remote_3',
        //             text: 'Cloud User 3',
        //             group: 'Fetched Data'
        //         },
        //         {
        //             value: 'remote_4',
        //             text: 'Cloud User 4',
        //             group: 'Fetched Data'
        //         }
        //     ]);

        //     // Create a blob URL to simulate fetching from a real remote domain
        //     const blob = new Blob([mockApiData], {
        //         type: 'application/json'
        //     });
        //     const mockApiUrl = URL.createObjectURL(blob);

        //     // Trigger the native fetch function inside your library
        //     await asyncSelect.fetch(mockApiUrl);

        //     btn.textContent = "Data Loaded Successfully!";
        //     btn.style.backgroundColor = "#40c979";
        //     btn.style.color = "#fff";
        // });
    </script>

</body>

</html>
