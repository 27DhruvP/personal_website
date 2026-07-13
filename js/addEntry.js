// =====================
// js/addEntry.js
// External JavaScript file for addEntry.php
//
// Assessment Criteria 4: Clear button event with confirm dialog (alert box)
// Assessment Criteria 5: preventDefault on blank form submission + CSS error highlighting
//
// NOTE: This file MUST be external (not embedded in HTML markup).
//       Per spec, embedded JS leads to zero marks.
// =====================

// Wait for the DOM to fully load before attaching event listeners
//A DOM is the structure of a webpage, represented as a tree of elements. The DOMContentLoaded event fires 
//when the initial HTML document has been completely loaded and parsed, without waiting for stylesheets, images, 
// and subframes to finish loading. This ensures that all the elements we want to interact with are available in 
// the DOM before our JavaScript code runs.
document.addEventListener("DOMContentLoaded", function () {

    // ---- Get references to DOM elements ----
    // In the speach marks is the id of the element we want to target. We use getElementById to 
    // get a reference to that element in our JavaScript code, allowing us to manipulate it
    var form         = document.getElementById("post-form");
    var titleInput   = document.getElementById("post-title");
    var contentInput = document.getElementById("post-content");
    var clearBtn     = document.getElementById("clear-btn");
    var titleError   = document.getElementById("title-error");
    var contentError = document.getElementById("content-error");

    // =====================================================
    // Assessment Criteria 4 — Clear Button Event Processing
    // When "Clear" is clicked:
    //   1. Show a confirm dialog (alert box) with OK / Cancel
    //   2. If OK  --> clear the title and content fields
    //   3. If Cancel --> do nothing (prevents accidental loss of input)
    // =====================================================
    clearBtn.addEventListener("click", function () {

        // Show confirm dialog as per spec requirement
        var userConfirmed = confirm("Are you sure you want to clear all fields? This cannot be undone.");

        if (userConfirmed) {
            // OK clicked — clear both inputs
            titleInput.value   = "";
            contentInput.value = "";

            // Also remove any error highlighting
            titleInput.classList.remove("input--error");
            contentInput.classList.remove("input--error");
            titleError.style.display   = "none";
            contentError.style.display = "none";
        }
        // If Cancel clicked — nothing happens (content preserved)
    });

    // =====================================================
    // Assessment Criteria 5 — Form Submission Validation
    // Uses preventDefault() to stop submission if fields are blank.
    // Highlights missing fields with a CSS class (input--error).
    // =====================================================
    form.addEventListener('submit', function (event) {

        var titleValue   = titleInput.value.trim();
        var contentValue = contentInput.value.trim();
        var hasError     = false;

        // Check title field
        if (titleValue === "") {
            // Stops automatic form submission to previewPost.php if the title is blank
            event.preventDefault();
            // Adds the input--error class to the title input, which applies a red border (defined in CSS)
            titleInput.classList.add("input--error");
            titleError.style.display = "block";
            hasError = true;
        } else {
            titleInput.classList.remove("input--error");
            titleError.style.display = "none";
        }

        // Check content field
        if (contentValue === "") {
            // Stops automatic form submission to previewPost.php if the content is blank
            event.preventDefault();
            contentInput.classList.add("input--error");
            contentError.style.display = "block";
            hasError = true;
        } else {
            contentInput.classList.remove("input--error");
            contentError.style.display = "none";
        }

        // If no errors, allow the form to submit to previewPost.php
    });

    // Remove error styling as soon as the user starts typing in a field
    titleInput.addEventListener("input", function () {
        if (titleInput.value.trim() !== "") {
            titleInput.classList.remove("input--error");
            titleError.style.display = "none";
        }
    });

    contentInput.addEventListener("input", function () {
        if (contentInput.value.trim() !== "") {
            contentInput.classList.remove("input--error");
            contentError.style.display = "none";
        }
    });

});