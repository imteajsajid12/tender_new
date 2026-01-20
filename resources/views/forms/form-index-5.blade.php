@extends('forms.layouts.header3')
@section('content')
    <?php
    $tenderid = 0;
    if (strpos($_SERVER['QUERY_STRING'], 'tenderid') >= 0) {
        $line0 = substr($_SERVER['QUERY_STRING'], strpos($_SERVER['QUERY_STRING'], 'tenderid') + 9);
        if (!strpos($line0, '&')) {
            $tenderid = $line0;
        } else {
            $tenderid = substr($line0, 0, strpos($line0, '&'));
        }
    }
    if (isset($_GET['file']) && $_GET['file'] != '') {
        $file = $_GET['file'];
    }
    $tenderdisplay = $_GET['tenderdisplay'];

    // function char_at($str, $pos)
    // {
    // 	return $str[$pos];
    // }
    $textChange = 'מכרז';
    if ($tender->tender_type != 0) {
        $textChange = 'משרה';
    }
    ?>

    @if ($tender->stopped == 1 || $tender->outofdate == 1)
        <h1 style="color:Red">
            המכרז אינו פעיל
        </h1>
    @endif
    <!--
                                                                                                                                                                    <script language="JavaScript">
                                                                                                                                                                        var csrfTag = document.createElement('meta');
                                                                                                                                                                        csrfTag.name = "csrf-token";
                                                                                                                                                                        csrfTag.content = "{{ csrf_token() }}";
                                                                                                                                                                        document.getElementsByTagName('head')[0].appendChild(csrfTag);
                                                                                                                                                                    </script>
                                                                                                                                                                    -->
    <style>
        .military_service_line {
            /* border: 1px solid #e0e0e0; */
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 5px;
            position: relative;
            /* background-color: #fafafa; */
        }

        .military_service_line .closebtn {
            /* position: absolute; */
            top: 10px;
            right: 10px;
            color: #dc3545;
            font-size: 14px;
            text-decoration: none;
            z-index: 10;
            background: #fff;
            border: 2px solid #dc3545;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: none;
            /* Hidden by default */
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 6px rgba(220, 53, 69, 0.2);
            transition: all 0.2s ease;
            cursor: pointer;
            line-height: 1;
            float: left;
        }

        .military_service_line .closebtn:hover {
            color: #fff;
            background-color: #dc3545;
            border-color: #dc3545;
            box-shadow: 0 4px 8px rgba(220, 53, 69, 0.3);
            transform: scale(1.1);
        }

        .military_service_line .closebtn i {
            font-size: 12px;
            font-weight: bold;
            line-height: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* First military service line should never show delete button */
        .military_service_line:first-child .closebtn {
            display: none !important;
        }

        /* Additional cards (not first) can show delete button when multiple exist */
        .military_service_line:not(:first-child) .closebtn {
            display: flex;
        }

        .military-duration-display {
            font-weight: bold;
            color: #007bff;
            padding: 8px 12px;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 4px;
            display: inline-block;
            min-width: 40px;
            text-align: center;
        }

        .military_service_block {
            margin-bottom: 20px;
        }

        .military_service_line:first-child {
            /* border-color: #007bff; */
            /* background-color: #f8f9ff; */
        }

        .addbutton.leftbtn {
            margin-top: 10px;
            margin-bottom: 20px;
        }
    </style>
    <style>
        /* Responsive table styling for conditions table */
        .table-responsive-wrapper {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            /* border: 1px solid #ddd; */
            border-radius: 4px;
            margin-bottom: 20px;
        }

        .conditions-table {
            width: 100%;
            border-collapse: collapse;
            margin: 0;
            background-color: white;
            min-width: 800px;
        }

        .conditions-table td {
            border: 0;
            padding: 12px 8px;
            text-align: right;
            vertical-align: top;
            word-wrap: break-word;
            background-color: white;
        }

        .conditions-table .condition-text {
            color: black;
            font-size: 14px;
            line-height: 1.4;
            max-width: 300px;
            word-break: break-word;
        }

        .conditions-table .file-block {
            min-width: 400px;
            max-width: 500px;
        }

        .file-upload-row {
            display: flex;
            flex-direction: row;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .btn-input-upload {
            min-width: 200px;
            max-width: 250px;
            font-size: 12px;
        }

        /* Print styles */
        @media print {
            .table-responsive-wrapper {
                overflow: visible !important;
                border: none !important;
            }

            .conditions-table {
                min-width: auto !important;
                font-size: 10px !important;
            }

            .conditions-table td {
                padding: 6px 4px !important;
                font-size: 10px !important;
            }

            .condition-text {
                font-size: 10px !important;
                max-width: none !important;
            }

            .file-block {
                min-width: auto !important;
                max-width: none !important;
            }

            .btn-input-upload {
                min-width: auto !important;
                max-width: none !important;
                font-size: 9px !important;
            }
        }

        /* Mobile responsive */
        @media (max-width: 768px) {
            .conditions-table {
                min-width: 600px;

                /* Additional responsive improvements for form layout */
                .faind_line.fullwidth {
                    overflow-x: auto;
                }

                .input-control.fg2 {
                    min-width: 200px;
                    flex: 1;
                }

                .captionline {
                    word-wrap: break-word;
                    overflow-wrap: break-word;
                }

                /* Responsive form fields */
                @media (max-width: 768px) {
                    .faind_line[style*="display:flex"] {
                        flex-direction: column !important;
                        gap: 15px;
                    }

                    .input-control.inline {
                        width: 100% !important;
                        margin-bottom: 15px;
                    }

                    .input-control.fg2 {
                        min-width: auto;
                        width: 100%;
                    }
                }

                /* Print improvements for form */
                @media print {
                    .faind_line.fullwidth {
                        overflow: visible !important;
                    }

                    .input-control {
                        page-break-inside: avoid;
                    }

                    .military_service_line {
                        page-break-inside: avoid;
                        margin-bottom: 10px;
                    }
                }
            }

            .condition-text {
                font-size: 13px;
                max-width: 250px;
            }

            .file-block {
                min-width: 300px;
                max-width: 400px;
            }

            .btn-input-upload {
                min-width: 150px;
                max-width: 200px;
                font-size: 11px;
            }
        }
    </style>

    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').prop('title', 'סוגי מסמכים מותרים הם: pdf עד 20 mb');

            // Set minimum date for military start date fields (today's date)
            setMilitaryStartDateMinimum();

            // Initialize military service delete button visibility
            updateMilitaryDeleteButtons();

            // Initialize military service durations on page load (for existing data)
            initializeMilitaryServiceDurations();

            // Re-initialize after delays to catch browser autofill
            // Browser autofill doesn't trigger change events, so we need to check again
            setTimeout(function() {
                initializeMilitaryServiceDurations();
            }, 500);

            setTimeout(function() {
                initializeMilitaryServiceDurations();
            }, 1500);

            // Add input event listeners to military date fields for real-time updates
            // This catches manual typing and other input methods
            $(document).on('input blur', '.military-start-date, .military-end-date', function() {
                validateMilitaryDates(this);
            });
        });

        // Function to set minimum date for military start date fields
        function setMilitaryStartDateMinimum() {
            // Do not set a minimum date for military start date fields
            // From Date can be any past date or today, but not future
            // The validation happens in validateMilitaryDates function
        }

        // Function to initialize military service durations when page loads with existing data
        function initializeMilitaryServiceDurations() {
            // Find all military service rows
            $('.military_service_line').each(function() {
                const container = $(this);
                const startDate = container.find('.military-start-date').val();
                const endDate = container.find('.military-end-date').val();
                const durationDisplay = container.find('.military-duration-display');

                // If both dates are filled, calculate duration
                if (startDate && endDate) {
                    const start = new Date(startDate);
                    const end = new Date(endDate);

                    // Only calculate if end date is not before start date
                    if (end >= start) {
                        const durationInMonths = calculateDurationInMonths(start, end);
                        durationDisplay.text(durationInMonths);
                    } else {
                        durationDisplay.text('0');
                    }
                } else {
                    durationDisplay.text('0');
                }
            });
        }

        // Function to validate military service dates
        function validateMilitaryDates(element) {
            const container = $(element).closest('.military_service_line');
            const startDate = container.find('.military-start-date').val();
            const endDate = container.find('.military-end-date').val();
            const durationDisplay = container.find('.military-duration-display');

            // Get today's date for comparison (set time to 00:00:00 for accurate comparison)
            const today = new Date();
            today.setHours(0, 0, 0, 0);

            // Check if the element being validated is a start date field (מתאריך)
            if ($(element).hasClass('military-start-date') && startDate) {
                const start = new Date(startDate);
                start.setHours(0, 0, 0, 0);

                // From Date: Cannot be in the future (can be past or today)
                if (start > today) {
                    alert('תאריך ההתחלה לא יכול להיות בעתיד. אנא בחר תאריך מהעבר או מהיום');
                    element.value = '';
                    durationDisplay.text('0');
                    return false;
                }
            }

            // Check if the element being validated is an end date field (עד תאריך)
            if ($(element).hasClass('military-end-date') && endDate) {
                const end = new Date(endDate);
                end.setHours(0, 0, 0, 0);

                // Until Date: Cannot be in the future
                if (end > today) {
                    alert('תאריך הסיום לא יכול להיות בעתיד. אנא בחר תאריך מהעבר או מהיום');
                    element.value = '';
                    durationDisplay.text('0');
                    return false;
                }
            }

            // Only validate dates within this specific row (no cross-row validation)
            if (startDate && endDate) {
                const start = new Date(startDate);
                const end = new Date(endDate);
                start.setHours(0, 0, 0, 0);
                end.setHours(0, 0, 0, 0);

                // Until Date: Cannot be earlier than From Date (can be same day)
                if (end < start) {
                    alert('תאריך הסיום לא יכול להיות קטן מתאריך ההתחלה');
                    element.value = '';
                    durationDisplay.text('0');
                    return false;
                }

                // Calculate duration based on actual calendar days
                const durationInMonths = calculateDurationInMonths(start, end);
                durationDisplay.text(durationInMonths);
            } else {
                durationDisplay.text('0');
            }
            return true;
        }

        // Function to calculate duration in months based on actual calendar days
        // Format: total months only (e.g., 13, 14, 18 months)
        // Rounding rule:
        //   - Days < 15: round down (count as 0 months)
        //   - Days >= 15: round up (count as 1 month)
        function calculateDurationInMonths(startDate, endDate) {
            // Calculate years, months, and remaining days
            let years = endDate.getFullYear() - startDate.getFullYear();
            let months = endDate.getMonth() - startDate.getMonth();
            let days = endDate.getDate() - startDate.getDate();

            // Adjust if days are negative
            if (days < 0) {
                months--;
                // Get the number of days in the previous month
                const prevMonth = new Date(endDate.getFullYear(), endDate.getMonth(), 0);
                days += prevMonth.getDate();
            }

            // Adjust if months are negative
            if (months < 0) {
                years--;
                months += 12;
            }

            // Convert to total months
            let totalMonths = (years * 12) + months;

            // Apply rounding rule based on remaining days:
            // If days < 15: don't add a month (round down to 0)
            // If days >= 15: add 1 month (round up)
            if (days >= 15) {
                totalMonths += 1;
            }

            // Handle edge case: if total service is less than 15 days, show 0
            if (years === 0 && months === 0 && days < 15) {
                return 0;
            }

            // Return total months only (e.g., 13, 14, 18) - not converted to years
            return Math.max(0, totalMonths);
        }

        // Generic function to validate date ranges
        function validateDateRange(element, startSelector, endSelector, errorMessage =
            'תאריך התחלה לא יכול להיות גדול מתאריך הסיום') {
            // Find the appropriate container - try multiple levels
            let container = $(element).closest('.faind_line');
            if (container.length === 0) {
                container = $(element).closest('[style*="display:flex"]');
            }
            if (container.length === 0) {
                container = $(element).closest('.military_service_line');
            }
            if (container.length === 0) {
                container = $(element).closest('form');
            }

            const startDate = container.find(startSelector).val();
            const endDate = container.find(endSelector).val();

            if (startDate && endDate) {
                const start = new Date(startDate);
                const end = new Date(endDate);

                // Validate that start date is not greater than end date
                if (start > end) {
                    alert(errorMessage);
                    element.value = '';
                    return false;
                }
            }
            return true;
        }

        // Specific validation functions for different sections
        function validateWorkExperienceDates(element) {
            const container = $(element).closest('.line, [id^="experience_line"]');
            const startInput = container.find('input[name="expe_start[]"]');
            const endInput = container.find('input[name="exp_finish[]"]');
            const today = new Date();
            today.setHours(0, 0, 0, 0);

            // Get current date in YYYY-MM-DD format for comparison (ensure local timezone)
            const year = today.getFullYear();
            const month = String(today.getMonth() + 1).padStart(2, '0');
            const day = String(today.getDate()).padStart(2, '0');
            const currentDateString = `${year}-${month}-${day}`;

            if (startInput.length && endInput.length) {
                const startDate = startInput.val();
                const endDate = endInput.val();

                // Validate start date if provided
                if (startDate) {
                    // Check if start date is in the future (allow current date)
                    if (startDate > currentDateString) {
                        alert('לא ניתן לבחור תאריך עתידי');
                        element.value = '';
                        return false;
                    }
                }

                // Validate end date if provided
                if (endDate) {
                    // Check if end date is in the future (allow current date)
                    if (endDate > currentDateString) {
                        alert('לא ניתן לבחור תאריך עתידי');
                        element.value = '';
                        return false;
                    }
                }

                if (startDate && endDate) {
                    const start = new Date(startDate);
                    const end = new Date(endDate);

                    // End date cannot be smaller than start date
                    if (end < start) {
                        alert('תאריך הסיום לא יכול להיות קטן מתאריך ההתחלה');
                        element.value = '';
                        return false;
                    }

                    // Check sequential validation for multiple entries
                    const allLines = $('#experience_block .line, [id^="experience_line"]:visible');
                    const currentIndex = allLines.index(container);

                    // Check against previous entry
                    if (currentIndex > 0) {
                        const prevLine = allLines.eq(currentIndex - 1);
                        const prevEndDate = prevLine.find('input[name="exp_finish[]"]').val();

                        if (prevEndDate) {
                            const prevEnd = new Date(prevEndDate);
                            // Current start must be greater than previous end
                            if (start <= prevEnd) {
                                alert('תאריך ההתחלה חייב להיות גדול מתאריך הסיום של מקום העבודה הקודם (' + prevEndDate +
                                    ')');
                                element.value = '';
                                return false;
                            }
                        }
                    }

                    // Check against next entry if it exists
                    if (currentIndex < allLines.length - 1) {
                        const nextLine = allLines.eq(currentIndex + 1);
                        const nextStartDate = nextLine.find('input[name="expe_start[]"]').val();

                        if (nextStartDate) {
                            const nextStart = new Date(nextStartDate);
                            // Current end must be less than next start
                            if (end >= nextStart) {
                                alert('תאריך הסיום חייב להיות קטן מתאריך ההתחלה של מקום העבודה הבא (' + nextStartDate +
                                    ')');
                                element.value = '';
                                return false;
                            }
                        }
                    }
                }
            }
            return true;
        }


        function validateManagementExperienceDates(element) {
            // Find the inputs directly within the management experience section
            const startInput = $('#expp_block input[name="expp_pstart[]"]');
            const endInput = $('#expp_block input[name="expp_finish[]"]');
            const today = new Date();
            today.setHours(0, 0, 0, 0);

            // Get current date in YYYY-MM-DD format for comparison (ensure local timezone)
            const year = today.getFullYear();
            const month = String(today.getMonth() + 1).padStart(2, '0');
            const day = String(today.getDate()).padStart(2, '0');
            const currentDateString = `${year}-${month}-${day}`;

            console.log('currentDateString', currentDateString, 'startDate', startInput.val(), 'end_date', endInput.val());

            if (startInput.length && endInput.length) {
                const startDate = startInput.val();
                const endDate = endInput.val();

                // Validate start date if provided
                if (startDate) {
                    // Allow current date - only block future dates
                    if (startDate > currentDateString) {
                        alert('לא ניתן לבחור תאריך עתידי');
                        element.value = '';
                        return false;
                    }
                }

                // Validate end date if provided
                if (endDate) {
                    // Allow current date - only block future dates
                    if (endDate > currentDateString) {
                        alert('לא ניתן לבחור תאריך עתידי');
                        element.value = '';
                        return false;
                    }
                }

                // Basic validation: end date cannot be smaller than start date
                if (startDate && endDate) {
                    const start = new Date(startDate);
                    const end = new Date(endDate);

                    if (end < start) {
                        alert('תאריך הסיום לא יכול להיות קטן מתאריך ההתחלה');
                        element.value = '';
                        return false;
                    }
                }
            }
            return true;
        }

        function validateOlderWorkerDates(element) {
            return validateDateRange(element, 'input[name="older_start_date"]', 'input[name="older_end_date"]');
        }

        // Function to validate course dates (קורסים והשתלמויות)
        function validateCourseDates(element) {
            const container = $(element).closest('.faind_line');
            const startDateInput = container.find('input[name="start_date"]');
            const endDateInput = container.find('input[name="end_date"]');
            const startDate = startDateInput.val();
            const endDate = endDateInput.val();

            // Get today's date for comparison (set time to 00:00:00 for accurate comparison)
            const today = new Date();
            today.setHours(0, 0, 0, 0);

            // Check if the element being validated is a start date field (מתאריך)
            if ($(element).attr('name') === 'start_date' && startDate) {
                const start = new Date(startDate);
                start.setHours(0, 0, 0, 0);

                // From Date: Cannot be in the future (can be past or today)
                if (start > today) {
                    alert('תאריך ההתחלה לא יכול להיות בעתיד. אנא בחר תאריך מהעבר או מהיום');
                    element.value = '';
                    return false;
                }
            }

            // Check if the element being validated is an end date field (עד תאריך)
            if ($(element).attr('name') === 'end_date' && endDate) {
                const end = new Date(endDate);
                end.setHours(0, 0, 0, 0);

                // Until Date: Cannot be in the future
                if (end > today) {
                    alert('תאריך הסיום לא יכול להיות בעתיד. אנא בחר תאריך מהעבר או מהיום');
                    element.value = '';
                    return false;
                }
            }

            // Validate date range: Until Date cannot be earlier than From Date
            if (startDate && endDate) {
                const start = new Date(startDate);
                const end = new Date(endDate);
                start.setHours(0, 0, 0, 0);
                end.setHours(0, 0, 0, 0);

                // Until Date: Cannot be earlier than From Date (can be same day)
                if (end < start) {
                    alert('תאריך הסיום לא יכול להיות קטן מתאריך ההתחלה');
                    element.value = '';
                    return false;
                }
            }
            return true;
        }

        // Override the dublibe function to handle military service duplication
        function dublibeMilitary(block, line) {
            var langPos = document.getElementById(block);
            var langLine = document.getElementById(line).cloneNode(true);

            // Clear input values in the cloned element
            var inputs = langLine.querySelectorAll('input, textarea');
            for (var i = 0; i < inputs.length; i++) {
                if (inputs[i].type !== 'hidden') {
                    inputs[i].value = '';
                }
            }

            // Generate unique file key for this military service entry
            var militaryIndex = langPos.children.length + 1;
            var baseFileKey = 'military_' + militaryIndex;

            // Update file upload structure for multiple files
            var fileBlocks = langLine.querySelectorAll('.file-block');
            fileBlocks.forEach(function(fileBlock) {
                var currentFileKey = baseFileKey;

                // Update hidden inputs for file tracking
                var formValsFile = fileBlock.querySelector('.formvalsfile');
                var formValsFileStatic = fileBlock.querySelector('.formvalsfilestatic');
                if (formValsFile) {
                    formValsFile.value = currentFileKey;
                }
                if (formValsFileStatic) {
                    formValsFileStatic.value = currentFileKey + '_9';
                }

                // Update all file upload elements within this block
                var fileLines = fileBlock.querySelectorAll('.add_file_line');
                fileLines.forEach(function(fileLine, index) {
                    var fileKey = currentFileKey;
                    if (index > 0) {
                        fileKey = currentFileKey + '_' + index;
                    }

                    // Update the main file line ID
                    fileLine.id = 'add_file_line_' + fileKey;

                    // Update all file-related elements with specific targeting
                    var rcFileUpload = fileLine.querySelector('[id*="rcfile-upload-"]');
                    if (rcFileUpload) rcFileUpload.id = 'rcfile-upload-' + fileKey;

                    var cFileUpload = fileLine.querySelector('input[type="file"]');
                    if (cFileUpload) cFileUpload.id = 'cfile-upload-' + fileKey;

                    var rElement = fileLine.querySelector('[id^="r"][id*="military_"]');
                    if (rElement) rElement.id = 'r' + fileKey;

                    var textInput = fileLine.querySelector('input[type="text"].btn-input-upload');
                    if (textInput) textInput.id = fileKey;

                    // Update labels and file input names
                    var labels = fileLine.querySelectorAll('label[for*="cfile-upload-"]');
                    labels.forEach(function(label) {
                        label.setAttribute('for', 'cfile-upload-' + fileKey);
                    });

                    var fileInputs = fileLine.querySelectorAll('input[type="file"]');
                    fileInputs.forEach(function(input) {
                        input.name = 'file[' + fileKey + ']';
                        input.id = 'cfile-upload-' + fileKey;
                    });

                    // Update onclick handlers for remove file buttons
                    var removeButtons = fileLine.querySelectorAll('[onclick*="removeFile"]');
                    removeButtons.forEach(function(btn) {
                        btn.setAttribute('onclick', "removeFile(this,'" + fileKey +
                            "');return false;");
                    });

                    // Hide additional file lines (only show first one)
                    if (index > 0) {
                        fileLine.style.display = 'none';
                    }
                });
            });

            // Reset duration display
            var durationDisplay = langLine.querySelector('.military-duration-display');
            if (durationDisplay) {
                durationDisplay.textContent = '0';
            }

            // Reset file upload displays
            var fileInputs = langLine.querySelectorAll('.btn-input-upload');
            fileInputs.forEach(function(input) {
                input.value = 'אנא צרף תעודה רלוונטית';
            });

            // Hide remove file buttons initially
            var removeFileBtns = langLine.querySelectorAll('[id*="rcfile-upload-"], [id^="r"][id*="military_"]');
            removeFileBtns.forEach(function(btn) {
                btn.style.display = 'none';
            });

            // Update the onclick handler for the add file button
            var addFileBtn = langLine.querySelector('button[onclick*="showLineFile"], button[onclick*="showMilitaryFile"]');
            if (addFileBtn) {
                addFileBtn.setAttribute('onclick', 'showMilitaryFile(this)');
            }

            langPos.appendChild(langLine);

            // Do not set minimum date for the newly added start date field
            // From Date can be any past date or today, but not future
            // The validation happens in validateMilitaryDates function

            // Update delete button visibility for all lines
            updateMilitaryDeleteButtons();
        }

        // Function to update delete button visibility
        function updateMilitaryDeleteButtons() {
            var militaryBlock = document.getElementById('military_service_block');
            if (!militaryBlock) return;

            var allLines = militaryBlock.querySelectorAll('.military_service_line');

            allLines.forEach(function(line, index) {
                var btn = line.querySelector('.closebtn');
                if (btn) {
                    // Never show delete button on first card (index 0)
                    // Only show on additional cards when there are multiple cards
                    if (index === 0 || allLines.length === 1) {
                        btn.style.display = 'none';
                    } else {
                        btn.style.display = 'flex';
                    }
                }
            });
        }

        // Function to remove a military service line
        function removeMilitaryLine(element) {
            const line = $(element).closest('.military_service_line');
            const block = line.parent();

            // Don't allow removing the first line or if it's the only line
            var allLines = block[0].querySelectorAll('.military_service_line');
            var lineIndex = Array.from(allLines).indexOf(line[0]);

            if (lineIndex === 0) {
                alert('לא ניתן למחוק את השורה הראשונה');
                return;
            }

            if (allLines.length > 1) {
                line.remove();
                // Update delete button visibility for remaining lines
                updateMilitaryDeleteButtons();
            } else {
                alert('לא ניתן למחוק את השורה האחרונה');
            }
        }

        // Keep the original closeLine function for other sections
        function closeLine(element) {
            const line = $(element).closest('.military_service_line');
            const block = line.parent();

            // Don't allow removing the last remaining line
            if (block.children('.military_service_line').length > 1) {
                line.remove();
            } else {
                alert('לא ניתן למחוק את השורה האחרונה');
            }
        }

        // Custom function for military service file uploads
        function showMilitaryFile(e) {
            var fileBlock = $(e).closest('.file-block');
            var formValsFile = fileBlock.find('input.formvalsfile');
            var formValsFileStatic = fileBlock.find('input.formvalsfilestatic');

            var currentVal = formValsFile.val(); // e.g., "military_1"
            var staticVal = formValsFileStatic.val(); // e.g., "military_1_9"

            // Extract the base key and current index
            var baseKey = currentVal.split('_')[0] + '_' + currentVal.split('_')[1]; // "military_1"
            var currentIndex = 0;

            // Find the current highest index
            if (currentVal.includes('_', currentVal.indexOf('_') + 1)) {
                var parts = currentVal.split('_');
                currentIndex = parseInt(parts[parts.length - 1]);
            }

            var nextIndex = currentIndex + 1;
            var nextKey = baseKey + '_' + nextIndex;

            // Check if we haven't reached the limit (9 additional files)
            if (nextIndex <= 9) {
                var nextElement = document.getElementById("add_file_line_" + nextKey);
                if (nextElement && nextElement.style) {
                    nextElement.style.display = '';
                    // Update the current value to the next key
                    formValsFile.val(nextKey);
                }
            }
        }
    </script>
    <form id="form" method="post" action="/page5/create" enctype="multipart/form-data">
        @if (isset($file))
            <div style="text-align: left;margin-bottom: 20px;">
                <a target="_blank" href="{{ asset('upload/admin/' . $file) }}" download style="margin-bottom: 5px">
                    הורדת קובץ צירוף תכולת מכרז
                </a>
            </div>
        @endif
        <div class="header_line faind_line">
            <!--@if ($tender->tender_type != 2)
    פרטי מכרז
@else
    פרטי משרה
    @endif-->
            פרטי {{ $textChange }}
        </div>
        @if ($tender->is_test_required)
            <div class="alert alert-info alert-link">מבחן חובה במשרה זו</div>
        @endif
        <div class="faind_line fullwidth">
            @if ($tender->tender_type != 1 && $tender->tender_type != 2)
                <div class="input-control">
                    <label>
                        <span class="caption captiobblue" style="font-weight: bold;">{{ $textChange }}</span><br>
                        @if ($tender->ttype == 1)
                            <label class="radio">
                                <input type="radio" name="tender_type" disabled {{ $tender->ttype == 1 ? 'checked' : '' }}
                                    value="yes" required="true" id="tender_type_yes">
                                <span class="virtual"></span>
                                <span class="caption"> {{ $textChange }} פנימי</span>
                            </label>
                        @elseif ($tender->ttype == 3)
                            <label class="radio">
                                <input type="radio" name="tender_type" disabled {{ $tender->ttype == 3 ? 'checked' : '' }}
                                    value="yes" required="true" id="tender_type_both">
                                <span class="virtual"></span>
                                <span class="caption"> פנימי/ חיצוני</span>
                            </label>
                        @else
                            <label class="radio">
                                <input type="radio" name="tender_type" disabled {{ $tender->ttype == 2 ? 'checked' : '' }}
                                    value="no" required="true">
                                <span class="virtual"></span>
                                <span class="caption"> {{ $textChange }} חיצוני</span>
                            </label>
                        @endif
                    </label>
                </div>
            @endif
            @if ($tender->tender_type != 1 && $tender->tender_type != 2)
                <div style="display:flex;">
                    <div>
                        תאריך התחלת {{ $textChange }}: {{ date('d-m-Y H:i', strtotime($tender->start_date)) }}
                        &nbsp;&nbsp;
                    </div>
                    <div>
                        תאריך סיום {{ $textChange }}: {{ date('d-m-Y H:i', strtotime($tender->finish_date)) }}
                        &nbsp;&nbsp;
                    </div>
                </div>
            @endif
        </div>
        <div class="faind_line fullwidth">

            <div class="input-control fg2">
                <label>
                    <!--@if ($tender->tender_type != 2)
    <span class="caption captiobblue"> מספר מכרז כפי שמופיע במסמכי המכרז:</span>
@else
    <span class="caption captiobblue"> מספר משרה כפי שמופיע במסמכי המכרז:</span>
    @endif-->
                    <span class="caption captiobblue"> מספר {{ $textChange }} כפי שמופיע במסמכי
                        ה{{ $textChange }}:</span>
                </label>
                <input type="hidden" name="tenderid" value="<?php echo $tenderid; ?>" />
                <div class="captionline"
                    style="margin-top:5px;padding-top:20px;margin-left:20px;padding-bottom:20px;text-align: center">
                    {{ $tender->tender_number }}
                </div>
            </div>
            <div class="input-control fg2">
                <label>
                    <span class="caption captiobblue">*  אגף/מחלקה</span>
                </label>
                <input type="hidden" name="brunch" value="<?php echo $tender->brunch; ?>" />
                <div class="captionline" style="margin-top:5px;padding-top:20px;padding-bottom:20px;text-align: center">
                    {{ $tender->brunch }}
                </div>
            </div>
            {{-- <div class="input-control fg2">
                <label>
                    <span class="caption captiobblue">*  רמה תפקודית</span>
                </label>
                <input type="hidden" name="tname" value="<?php echo $tender->tname; ?>" />
                <input type="hidden" name="tender_id" value="<?php echo $tender->id; ?>" />
                <div class="captionline" style="margin-top:5px;padding-top:20px;padding-bottom:20px;text-align: center">
                    {{ collect($tender->functional_level)->join(', ',' and ') }}
                </div>
            </div> --}}
            <div class="input-control fg2">
                <label>
                    <span class="caption captiobblue">*  מועמד/ת לתפקיד</span>
                </label>
                <input type="hidden" name="tname" value="<?php echo $tname; ?>" />
                <div class="captionline" style="margin-top:5px;padding-top:20px;padding-bottom:20px;text-align: center">
                    {{ $tname }}
                </div>
            </div>
        </div>
        <div class="faind_line fullwidth">

            <div class="input-control fg2">
                <label><span class="caption captiobblue">מנהל </span></label>
                <div class="captionline"
                    style="margin-top:5px;padding-top:20px;margin-left:20px;padding-bottom:20px;text-align: center">
                    {{ $tender->input_manager }}
                </div>
            </div>

            <div class="input-control fg2">
                <label><span class="caption captiobblue">היקף </span></label>
                <div class="captionline"
                    style="margin-top:5px;padding-top:20px;margin-left:20px;padding-bottom:20px;text-align: center">
                    {{ $tender->job_scope }}
                </div>
            </div>

            <div class="input-control fg2">
                <label><span class="caption captiobblue">כפיפות</span></label>
                <div class="captionline"
                    style="margin-top:5px;padding-top:20px;margin-left:20px;padding-bottom:20px;text-align: center">
                    {{ $tender->subordinations }}
                </div>
            </div>

            <div class="input-control fg2">
                <label><span class="caption captiobblue">דרגת המשרה ודירוגה</span></label>
                <div class="captionline"
                    style="margin-top:5px;padding-top:20px;margin-left:20px;padding-bottom:20px;text-align: center">
                    {{ $tender->grades_voltage }}
                </div>
            </div>



        </div>


        <div class="faind_line fullwidth">
            @if ($tender->ttype == 1)
                <div class="text">
                    בהתאם להוראות משרד הפנים ל{{ $textChange }} פנימי רשאי לגשת עובד קבוע המועסק ברשות מעל שנתיים.<br>
                    יובהר כי עובד המועסק במשרה זמנית ועובד המועסק על בסיס שכר שעתי אינם רשאים להתמודד ב{{ $textChange }}
                    פנימי.<br>
                    כמו כן עובד שתפקידו אינו מזכה אותו בקביעות אינו זכאי לגשת ל{{ $textChange }} פנימי.
                </div>
            @endif
        </div>

        @if (count($conditions) > 0)
            <div class="header_line faind_line">
                תנאי סף </div>
        @endif

        <div
            style="direction: rtl; text-align: right; margin-bottom: 20px; padding: 10px;

    text-transform: uppercase;
    text-align: right;  color: #31a7d9; font-size: 16px; line-height: 1.6;">
            <strong>מועמד יקר שים לב!</strong><br><br>
            <u>אישורים עבור ניסיון מקצועי / ניסיון ניהולי יכללו את הפרטים הבאים:</u><br>

            א. אישור חתום ע"י המעסיק<br>
            ב. תקופת העסקה מפורטת: מתאריך (יום/חודש /שנה) עד תאריך (יום/חודש /שנה)<br>
            ג. פירוט היקף המשרה (אחוזי העסקה)<br>
            ד. תיאור תמציתי של תוכן התפקיד – מותאם לתנאי הסף הנדרשים<br>
            ה. במידה ונדרש ניסיון ניהולי - על האישור לכלול גם את כמות העובדים שנוהלו על ידי המועמד באופן ישיר. (ככל שבוצעו
            מספר תפקידים באותו מקום עבודה על האישור להיות מפורט כאמור לעיל ביחס לכל אחד מהם)
        </div>


        <div style="height:2px; width:100%; background:#31a7d9; margin-bottom:30px; border-radius:2px;"></div>
        <div class="faind_line">
            @if (count($conditions) > 0)
                <div class="input-control" style="width:100%">
                    <?php
                    $y = count($form_file) - 2; // 52;
                    $x = 3;
                    $isHeader1 = false;
                    $isHeader2 = false;
                    $isHeader3 = false;
                    $isHeader4 = false;
                    $isHeader5 = false;
                    $isHeader6 = false;
                    //var_dump($conditions);
                    ?>

                    <div class="table-responsive-wrapper">
                        <table class="conditions-table" style=" border: none !important;">
                            <?php
                            $sum = 0;
                            $i = 0;
                            // dd($conditions);
                            // function normalizeArray($conditions) {
                            //     return array_map(function($item) {
                            //         // remove square brackets and their contents
                            //         $item = preg_replace('/\[[^\]]*\]/', '', $item);
                            //         return trim($item);
                            //     }, $conditions);
                            // }
                            // $conditions = normalizeArray($conditions);
                            ?>
                            @foreach ($conditions as $k => $condition)
                                <?php

                                //echo $condition."</Br>";
                                if (strpos($condition, '=>') !== false) {
                                    $header = explode('=>', $condition);
                                }
                                if (strpos($condition, '=>') !== false) {
                                    $con = explode('=>', preg_replace('/\[[^\]]*\]/', '', $condition));
                                    // $con = explode('=>', $condition);
                                    $required = $con[1];
                                    if ($required === 'not_required') {
                                        $required_val = '';
                                    } else {
                                        $required_val = 'required';
                                    }
                                } else {
                                    $required_val = 'required';
                                    //$con[0] = '';
                                }
                                $index_open = strpos($condition, '[');
                                $index = $condition[$index_open + 1];
                                //var_dump($index_open);
                                if (is_numeric($index)) {
                                    $key = $index + $x;
                                    if (strpos($con[0], $form_file[$key]['title']) !== false) {
                                        $file = $form_file[$key];
                                    }
                                } else {
                                    ++$y;
                                    $file = ['name' => 'tender_add_cond[' . $y . ']', 'title' => $condition, 'show_type' => '', 'required' => ''];
                                    $key = $y;
                                }
                                ?>
                                @if (!$isHeader1 && isset($header[1]) && $header[1] === 'השכלה ודרישות מקצועיות')
                                    <tr>
                                        <td class="caption captiobblue" style="font-weight: bold;border:0;">
                                            {{ $header[1] }}</td>
                                    </tr>
                                    <?php $isHeader1 = true; ?>
                                @endif
                                @if (!$isHeader2 && isset($header[1]) && $header[1] === 'קורסים והכשרות מקצועיות')
                                    <tr>
                                        <td class="caption captiobblue" style="font-weight: bold;border:0;">
                                            {{ $header[1] }}</td>
                                    </tr>
                                    <?php $isHeader2 = true; ?>
                                @endif
                                @if (!$isHeader3 && isset($header[1]) && $header[1] === 'ניסיון מקצועי')
                                    <tr>
                                        <td class="caption captiobblue" style="font-weight: bold;border:0;">
                                            {{ $header[1] }}</td>
                                    </tr>
                                    <?php $isHeader3 = true; ?>
                                @endif
                                @if (!$isHeader4 && isset($header[1]) && $header[1] === 'דרישות נוספות')
                                    <tr>
                                        <td class="caption captiobblue" style="font-weight: bold;border:0;">
                                            {{ $header[1] }}</td>
                                    </tr>
                                    <?php $isHeader4 = true; ?>
                                @endif
                                @if (!$isHeader5 && isset($header[1]) && $header[1] === 'ניסיון ניהול')
                                    <tr>
                                        <td class="caption captiobblue" style="font-weight: bold;border:0;">
                                            {{ $header[1] }}</td>
                                    </tr>
                                    <?php $isHeader5 = true; ?>
                                @endif
                                @if (!$isHeader6 && isset($header[1]) && ($header[1] === 'שאלות כן ולא' || strpos($condition, '[doc6]') !== false))
                                    <tr>
                                        <td class="caption captiobblue" style="font-weight: bold;border:0;">
                                            שאלות כן ולא</td>
                                    </tr>
                                    <?php
                                    $isHeader6 = true;
                                    //var_dump($con);
                                    ?>
                                @endif
                                <?php
                                // Check if this is a doc6 (Yes/No) condition by looking for [doc6] in the condition string
                                $isCurrentDoc6 = strpos($condition, '[doc6]') !== false;
                                $sum = $sum + 100;
                                ?>

                                @if (
                                    (strpos($condition, '=>required') !== false ||
                                        strpos($condition, '=>not_required') !== false ||
                                        strpos($condition, '=>no') !== false) &&
                                        isset($key))
                                    <tr id="{{ $key }}">
                                        <td class="condition-text">
                                            <div style="color:black">
                                                {{ $con[0] }}
                                                @if (!$isHeader6 && !$isCurrentDoc6)
                                                    <span style="margin-right: 5px;" data-toggle="tooltip"
                                                        title="סוגי מסמכים מותרים הם: jpg, jpeg, doc, docx ו pdf עד 20 mb"><i
                                                            class="fas fa-info-circle" aria-hidden="true"></i>
                                                    </span>
                                                @else
                                                    <span style="margin-right: 5px;" data-toggle="tooltip"
                                                        title="כֵּן או לֹא"><i class="fas fa-info-circle"
                                                            aria-hidden="true"></i>
                                                    </span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="file-block">
                                            <?php $ind = $key + $sum; ?>
                                            @if (!$isHeader6 && !$isCurrentDoc6)
                                                <input type="hidden" name="vals" class="formvalsfile"
                                                    value="{{ $ind }}" />
                                                <input type="hidden" name="valsstatic" class="formvalsfilestatic"
                                                    value="{{ $ind }}" />
                                                <?php for($z=0; $z<10; $z++,$ind++){

                                                    if($z==0){
                                                        $style= "";
                                                    }else{
                                                        $style = "style=display:none";
                                                        $required_val="";
                                                    }
                                                        ?>

                                                <div id="add_file_line_{{ $ind }}" class="add_file_line"
                                                    {{ $style }}>
                                                    <div class="file-upload-row">
                                                        <div>
                                                            <div class="upload-block">

                                                                <a href="#" id="rcfile-upload-{{ $ind }}"
                                                                    class="rm" style="display:none"
                                                                    onclick="removeFile(this,{{ $ind }});return false;"><i
                                                                        class="trash-icon"></i></a>
                                                                <input id="{{ $ind }}" type="text" disabled
                                                                    class="btn-input-upload data-val"
                                                                    value="אנא צרף.י תעודה רלוונטית"
                                                                    data-key="{{ $ind }}"
                                                                    data-cond="{{ $con[0] }}"
                                                                    data-val="{{ $required_val }}" />
                                                                <label for="cfile-upload-{{ $ind }}"
                                                                    class="btn-upload">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                        width="19px" height="13px"
                                                                        style="transform: scale(0.8)  translateY(4px);">
                                                                        <path fill-rule="evenodd" fill="rgb(128, 184, 57)"
                                                                            d="M14.537,4.008 L-0.000,4.008 L3.496,13.001 L17.666,13.001 L14.537,4.008 ZM19.000,-0.001 L13.480,-0.001 L12.375,2.000 L3.508,2.000 L3.510,2.985 L15.230,2.985 L18.725,13.001 L19.000,13.001 L19.000,-0.001 Z" />
                                                                    </svg>

                                                                    <span style="margin-top:-2px">

                                                                        בחר קובץ
                                                                    </span>
                                                                </label>

                                                                <input id="cfile-upload-{{ $ind }}"
                                                                    type="file" name="file[{{ $ind }}]"
                                                                    onchange="fileChange(this);" accept="application/pdf"
                                                                    {{ $required_val }} />

                                                            </div>

                                                        </div>
                                                        <div class="aline">
                                                            <button type="button" class="addbutton"
                                                                onclick="showLineFile(this)"
                                                                style="width:30px; height:30px; padding:0;">
                                                                <img src="/img/icons/plus.png" />

                                                            </button>
                                                        </div>

                                                        <?php if($z ==0){?>
                                                        @if ($required_val === 'required')
                                                            <div style="color:red; font-size: 10px; margin-right: 3px;">
                                                                תנאי סף
                                                                מסמך חובה לצירוף</div>
                                                        @else
                                                            <div style="color:green; font-size: 10px; margin-right: 3px;">
                                                                יתרון
                                                                מסמך לא חובה לצירוף</div>
                                                        @endif
                                                        <?php } ?>

                                                    </div>
                                                </div>

                                                <?php
                                            }
                                            ?>
                                            @else
                                                <div id="add_file_line_{{ $ind }}" class="add_file_line">
                                                    <div class="file-upload-row">
                                                        <input type="hidden" name="condition_question[]"
                                                            value="{{ $con[0] }}">
                                                        <label style="margin-right:15px; font-weight: 600;"
                                                            for="yes_{{ $i }}">כֵּן</label>
                                                        <input type="radio" id="yes_{{ $i }}"
                                                            name="condition_answer[{{ $i }}]" value="1"
                                                            checked="checked">
                                                        <label style="margin-right:15px; font-weight: 600;"
                                                            for="no_{{ $i }}">לֹא</label>
                                                        <input type="radio" id="no_{{ $i }}"
                                                            name="condition_answer[{{ $i }}]" value="0">
                                                        <input
                                                            style="margin-right:15px; padding: 6px 10px; border: 1px solid #ddd; border-radius: 4px;"
                                                            type="text" name="condition_answer_text[]" value=""
                                                            placeholder="הערות (אופציונלי)">
                                                    </div>
                                                </div>
                                                @php
                                                    $i++;
                                                @endphp
                                            @endif
                                        </td>
                                    </tr>
                                @elseif(strpos($condition, '=>cond_or') !== false)
                                    <?php
                                    if (strpos($condition, '=>cond_or') !== false) {
                                        $cond_or = explode('=>cond_or', $condition);
                                        //var_dump($cond_or[0]);
                                    } else {
                                        $cond_or[0] = '';
                                    }
                                    $y++;
                                    $key = $y;
                                    //echo $key;
                                    $file = ['name' => 'tender_cond_or[' . $key . ']', 'title' => $condition, 'show_type' => '', 'required' => ''];
                                    ?>
                                    <tr id="{{ $key }}">
                                        <td class="condition-text">
                                            <div style="color:black"><b>או</b> {{ $cond_or[0] }}<span
                                                    style="margin-right: 5px;" data-toggle="tooltip"
                                                    title="סוגי מסמכים מותרים הם: jpg, jpeg, doc, docx ו pdf עד 20 mb"><i
                                                        class="fas fa-info-circle" aria-hidden="true"></i></span></div>

                                        </td>
                                        <td class="file-block">
                                            <?php $ind = $key + $sum; ?>
                                            <input type="hidden" name="vals" class="formvalsfile"
                                                value="{{ $ind }}" />
                                            <input type="hidden" name="valsstatic" class="formvalsfilestatic"
                                                value="{{ $ind }}" />
                                            <?php for($z=0; $z<10; $z++,$ind++){

                                        if($z==0){
                                            $style= "";
                                        }else{
                                            $style = "style=display:none";
                                            $required_val="";
                                        }

                                            ?>
                                            <div id="add_file_line_{{ $ind }}" class="add_file_line"
                                                {{ $style }}>
                                                <div class="file-upload-row">
                                                    <div>
                                                        <div class="upload-block">

                                                            <a href="#" id="rcfile-upload-{{ $key }}"
                                                                class="rm" style="display:none"
                                                                onclick="removeFile(this,{{ $key }});return false;"><i
                                                                    class="trash-icon"></i></a>
                                                            <input id="{{ $key }}" type="text" disabled
                                                                class="btn-input-upload condition-or"
                                                                value="אנא צרף תעודה רלוונטית"
                                                                data-key="{{ $key }}"
                                                                data-cond="{{ $cond_or[0] }}" />
                                                            <label for="cfile-upload-{{ $key }}"
                                                                class="btn-upload">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                    width="19px" height="13px"
                                                                    style="transform: scale(0.8)  translateY(4px);">
                                                                    <path fill-rule="evenodd" fill="rgb(128, 184, 57)"
                                                                        d="M14.537,4.008 L-0.000,4.008 L3.496,13.001 L17.666,13.001 L14.537,4.008 ZM19.000,-0.001 L13.480,-0.001 L12.375,2.000 L3.508,2.000 L3.510,2.985 L15.230,2.985 L18.725,13.001 L19.000,13.001 L19.000,-0.001 Z" />
                                                                </svg>

                                                                <span style="margin-top:-2px">

                                                                    בחר קובץ
                                                                </span>
                                                            </label>

                                                            <input id="cfile-upload-{{ $key }}" type="file"
                                                                name="file[{{ $key }}]"
                                                                onchange="fileChange(this);"
                                                                accept="application/pdf, image/jpeg, image/jpg, .doc,.docx, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/msword"
                                                                required data-val="condition-or" />


                                                        </div>
                                                    </div>
                                                    <div class="aline">
                                                        <button type="button" class="addbutton"
                                                            onclick="showLineFile(this)"
                                                            style="width:30px; height:30px; padding:0;">
                                                            <img src="/img/icons/plus.png" />

                                                        </button>
                                                    </div>

                                                </div>
                                            </div>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                @elseif(strpos($condition, '=>confirm') !== false)
                                    <?php
                                    if (strpos($condition, '=>confirm') !== false) {
                                        $confirm = explode('=>confirm', $condition);
                                        //var_dump($cond_or[0]);
                                    } else {
                                        $confirm[0] = '';
                                    }
                                    ?>
                                    <tr>
                                        <td class="condition-text">
                                            <div style="color:black">{{ $confirm[0] }}<span
                                                    style="margin-right: 5px;"></span></div>
                                            <input type="checkbox" name="{{ $confirm[0] }}" class=""
                                                style="transform: translateY(8px);margin-left:3px;" value="1"
                                                required />
                                            <label>
                                                מאשר/ת שהנני עומד/ת בדרישות אלה
                                            </label>
                                        </td>
                                        <td class="condition-text">

                                        </td>
                                @endif
                            @endforeach
                        </table>

                        @foreach ($conditions as $condition)
                            @if (strpos($condition, '=>') === false)
                                <div style="color:black">{{ $condition }}</div>
                                <span class="caption captiobblue" style="font-weight: bold;">פירוט</span>
                                <textarea class="detail" name="condition_text" {{ $required_val }}></textarea>
                            @endif
                        @endforeach
                    </div><br />
                    <span>

                        <input type="checkbox" name="conditions_ok" class=""
                            style="transform: translateY(8px);margin-left:3px;" value="1" id="conditions_ok"
                            required>
                        <label>
                            הנני מאשר כי אני עומד בכל התנאי סף
                        </label>
                    </span>
                </div>
            @endif

            <div class="header_line faind_line">
                פרטים אישיים
            </div>
            <div class="faind_line "
                style="display:flex; flex-direction: row; flex-wrap:wrap; justify-content: space-between">

                <div class="input-control inline fg2">
                    <div>
                        <div class="caption bold max-w300">* שם פרטי</div>
                        <input type="text" name="firstname" required="" class="max-250" placeholder="">
                    </div>
                </div>
                <div class="input-control inline fg2">
                    <div>
                        <div class="caption bold max-w300">* שם משפחה</div>
                        <input type="text" name="lastname" required="" class="max-250" placeholder="">
                    </div>
                </div>
                <div class="input-control inline fg2">
                    <div>
                        <div class="caption bold max-w300">* שם משפחה קודם</div>
                        <input type="text" name="oldlastname" required="" class="max-250" placeholder="">
                    </div>
                </div>
                <div class="input-control inline fg2">
                    <div>
                        <div class="caption bold max-w300">* מספר ת.ז</div>
                        <input type="text" name="id_tz" required="" minlength="9" maxlength="9"
                            pattern="^[0-9]+$" class="max-250 id_number" placeholder="">
                    </div>
                </div>
                <div class="input-control inline fg2">
                    <div>
                        <div class="caption bold max-w300">* כתובת דוא"ל</div>
                        <input placeholder="username@domainname.co.il" type="email" name="email" required=""
                            class="mmax-440">
                    </div>
                </div>
                <div class="input-control inline fg2">
                    <div>
                        <div class="caption bold max-w300">* מספר טלפון נייד</div>
                        <input type="text" name="personal_phone" pattern="^[0-9]+$" minlength="7" maxlength="7"
                            class="mmax-280" placeholder="" required="">
                        <select class="max-65 phn" name="personal_phone_select">
                            <option value="050">050</option>
                            <option value="052"> 052</option>
                            <option value="053"> 053</option>
                            <option value="054"> 054</option>
                            <option value="055"> 055</option>
                            <option value="057"> 057</option>
                            <option value="058"> 058</option>
                        </select>
                    </div>
                </div>
                <div class="input-control inline fg2">
                    <label>
                        <span class=" captiobblue" style="font-weight: bold;">מין</span><br>
                        <label class="radio">
                            <input type="radio" name="gender" value="male">
                            <span class="virtual"></span>
                            <span class="caption">זכר</span>
                        </label>
                        <label class="radio">
                            <input type="radio" name="gender" value="female">
                            <span class="virtual"></span>
                            <span class="caption">נקבה</span>
                        </label>
                    </label>
                </div>
                <hr>
                <div class="input-control inline fg2">
                    <div>
                        <div class="caption bold max-w300">* עיר מגורים</div>
                        <input type="text" name="personal_city" required="" class="mmax-440" placeholder="">
                    </div>
                </div>
                <div class="input-control inline fg2">
                    <div>
                        <div class="caption bold max-w300">* רחוב</div>
                        <input type="text" name="personal_street" required="true" class="mmax-440" placeholder="">
                    </div>
                </div>
                <div class="input-control inline fg2">
                    <div>
                        <div class="caption bold max-w300">* מספר בית</div>
                        <input type="text" name="personal_house" required="" pattern="^[0-9]+$" class="mmax-440"
                            placeholder="">
                    </div>
                </div>
                <div class="input-control inline fg2">
                    <div>
                        <div class="caption bold max-w300">מספר דירה</div>
                        <input type="text" name="personal_flat" pattern="^[0-9]+$" class="mmax-440" placeholder="">
                    </div>
                </div>
                <div class="input-control inline fg2">
                    <div>
                        <div class="caption bold max-w300">* מיקוד</div>
                        <input type="text" name="personal_zipcode" required pattern="^[0-9]+$" class="mmax-440"
                            placeholder="">
                    </div>
                </div>
            </div>

            <div class="faind_line">
                <div class="input-control inline fg2">
                    <label></label>
                    <label>
                        <span class="caption" style="font-weight: bold;"> כתובת למשלוח דואר</span><br>
                        <label class="radio">
                            <input onchange="showchangepostaladdress()" type="radio" checked
                                name="personal_postal_address" value="yes" required=""
                                id="personal_postal_address_yes">
                            <span class="virtual"></span>
                            <span class="scaption">כתובת למשלוח דואר זהה לכתובת המגורים</span>
                        </label>
                        <label class="radio">
                            <input type="radio" onchange="showchangepostaladdress()" name="personal_postal_address"
                                value="no" required="" id="personal_postal_address_no">
                            <span class="virtual"></span>
                            <span class="scaption">כתובת למשלוח דואר שונה מכתובת המגורים</span>
                        </label>
                    </label>
                    <div id="postalblock" data-show_type="personal_postal_address_no"><input id="postalinout"
                            type="text" name="postal" placeholder="אנא הזן את הכתובת המלאה למשלוח דואר" /></div>
                </div>
            </div>
            <div>
                <br />
                <div class="header_line faind_line">
                    שירות לאומי/צבאי
                </div>
                <!-- שירות לאומי/צבאי (National/Military Service) Section -->
                <div class="faind_line fullwidth">
                    <div id="military_service_block" class="military_service_block">
                        <div id="military_service_line" class="military_service_line">
                            <div class="faind_line">
                                <div style="display: flex; flex-wrap: wrap; align-items: end;">
                                    <div class="input-control inline">
                                        <div>
                                            <div class="caption max-w300">מתאריך</div>
                                            <input type="date" name="military_from_date[]"
                                                class="max-220 military-start-date" placeholder=""
                                                onchange="validateMilitaryDates(this)">
                                        </div>
                                    </div>
                                    <div class="input-control inline">
                                        <div>
                                            <div class="caption max-w300">עד תאריך</div>
                                            <input type="date" name="military_to_date[]"
                                                class="max-220 military-end-date" placeholder=""
                                                onchange="validateMilitaryDates(this)">
                                        </div>
                                    </div>
                                    <div class="input-control inline">
                                        <div>
                                            <div class="caption max-w300">תפקידים</div>
                                            <input type="text" name="military_roles[]" class="max-220"
                                                placeholder="">
                                        </div>
                                    </div>
                                    <div class="input-control inline">
                                        <div>
                                            <div class="caption max-w300">משך השירות (חודשים)</div>
                                            <span class="military-duration-display">0</span>
                                        </div>
                                    </div>
                                    <!-- File Upload Section -->
                                    <div class="input-control btn-descr file-block" style="margin-right: 10px;">
                                        <div class="caption max-w300">צרף מסמך רלוונטי <span style="margin-right: 5px;"
                                                data-toggle="tooltip" title="סוגי מסמכים מותרים הם: pdf עד 20 mb"><i
                                                    class="fas fa-info-circle" aria-hidden="true"></i></span></div>

                                        <?php
                                        $key = 'military_1';
                                        $keyNum = 1;
                                        ?>
                                        <input type="hidden" name="vals" class="formvalsfile"
                                            value="{{ $key }}" />
                                        <input type="hidden" name="valsstatic" class="formvalsfilestatic"
                                            value="{{ $key }}_9" />

                                        <?php for($z=0; $z<10; $z++, $keyNum++){
                                        $currentKey = $key . ($z > 0 ? '_' . $z : '');
                                        if($z==0){
                                            $style= "";
                                        }else{
                                            $style = "style=display:none";
                                        }
                                    ?>
                                        <div id="add_file_line_{{ $currentKey }}" class="add_file_line"
                                            {{ $style }}>
                                            <div class="file-upload-row">
                                                <div class="upload-block">
                                                    <a href="#" id="rcfile-upload-{{ $currentKey }}"
                                                        class="rm" style="display:none"
                                                        onclick="removeFile(this,'{{ $currentKey }}');return false;"><i
                                                            class="trash-icon"></i></a>
                                                    <input id="{{ $currentKey }}" type="text" disabled
                                                        class="btn-input-upload" value="אנא צרף תעודה רלוונטית" />
                                                    <label for="cfile-upload-{{ $currentKey }}" class="btn-upload ">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="19px"
                                                            height="13px"
                                                            style="transform: scale(0.8)  translateY(4px);">
                                                            <path fill-rule="evenodd" fill="rgb(128, 184, 57)"
                                                                d="M18.194,8.042 L10.152,0.000 L2.110,8.042 L4.932,8.042 L4.932,13.000 L15.372,13.000 L15.372,8.042 L18.194,8.042 Z" />
                                                        </svg>
                                                        בחר קובץ
                                                    </label>
                                                    <input id="cfile-upload-{{ $currentKey }}" type="file"
                                                        name="file[{{ $currentKey }}]" onchange="fileChange(this)"
                                                        accept="application/pdf" style="display: none;" />
                                                    <a href="#" id="r{{ $currentKey }}" class="rm"
                                                        style="display:none"
                                                        onclick="removeFile(this,'{{ $currentKey }}');return false;"><i
                                                            class="trash-icon"></i></a>
                                                </div>
                                                <?php if($z == 0) { ?>
                                                <div class="aline">
                                                    <button type="button" class="addbutton"
                                                        onclick="showMilitaryFile(this)"
                                                        style="width:30px; height:30px; padding:0;">
                                                        <img src="/img/icons/plus.png" />
                                                    </button>
                                                </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <a href="#" class="closebtn" onclick="removeMilitaryLine(this)"><i
                                    class="fas fa-times"></i></a>
                        </div>
                    </div>
                </div>
                <div class="aline" style="flex-direction: row-reverse; clear: both;">
                    <button type="button" class="addbutton leftbtn"
                        onclick="dublibeMilitary('military_service_block','military_service_line')">
                        <img src="/img/icons/plus.png" />
                        הוסף שירות נוסף
                    </button>
                </div>
                {{-- <div class="header_line faind_line">
                    ניסיון תעסוקתי רלוונטי
                </div>
                @if ($tender->job_details)
                    @foreach ($tender->job_details as $item)
                        {{ config('static_array.jobDetails')[$item] }},
                    @endforeach.
                @endif --}}
                {{-- <div class="text">
                    ניסיון מקצועי: אישורי העסקה הכוללים בין היתר תקופת העבודה, היקף המשרה, ותיאור תמציתי של תוכן התפקיד.
                    במקרים חריגים בהם אין בידי המועמד אפשרות להציג אישור מעסיק ממעסיקים קודמים, יהיה עליו להגיש תצהיר חתום:
                    ככלל, מועמד המבקש להשתתף ב{{ $textChange }}, נדרש לצרף קורות חיים והעתקי מסמכים המעידים על השכלה
                    וניסיון כנדרש בנוסח ה{{ $textChange }} שפורסם. במקרים החריגים כדלהלן:<br>
                    א. סגירת מקום העבודה או הלימודים<br>
                    ב. בעל עסק עצמאי<br>
                    ג. שמירה על דיסקרטיות במקום העבודה הנוכחי<br>
                    ד. סירוב מקום העבודה או מוסד הלימודים להמצאת אישור העסקה או לימודים, בכפוף להמצאת אסמכתא תומכת בדבר
                    הפנייה למקום העבודה או הלימודים וסירובם להמציא את האישור הנדרש<br>
                    רשאי המועמד להגיש תצהיר חתום על ידי עו"ד ובו פירוט הנסיבות בגינן לא ניתן להציג אישור כאמור וכן פירוט
                    בדבר השכלתו ו/או ניסיונו של המועמד , וזאת בצירוף אישור המוסד לביטוח לאומי המפרט את תקופות ההעסקה.
                    <ul>
                        <li>
                            עבודה ביותר מחצי משרה תיחשב כמשרה מלאה לצורך עמידה בתנאי הסף.
                            עבודה בחצי משרה או פחות מכך, ובלבד שלא תפחת מ 25% משרה, תחושב באופן משוקלל.</li>
                        <li>
                            ניסיון במגזר הציבורי מוגדר כניסיון בתעסוקה בגופי ממשלה, רשויות מקומיות, תאגידים סטטוטוריים,
                            תאגידים עירוניים וחברות ממשלתיות.</li>
                        <li>
                            ניסיון שנרכש בשירות צבאי חובה או שירות לאומי ייחשבו כניסיון מקצועי לעניין עמידה
                            בתנאי סף, ובלבד שמדובר בניסיון מוכח ורלוונטי לביצוע התפקיד בהתאם לתחומי העיסוק המפורטים בו.</li>
                        <li>
                            לניסיון מקצועי בתחום המשפטים ייחשב הניסיון שנצבר לאחר קבלת הרישיון מלשכת
                            עורכי הדין בישראל (למען הסר ספק, תקופת ההתמחות אינה באה בחשבון מניין שנות
                            הניסיון המקצועי( עם זאת, מובהר כי תקופת עבודה כתובע צבאי, כתובע במשטרה, כנציג
                            היועץ המשפטי לממשלה המופיע בבתי משפט וכו' (אף אם במהלכה לא היה בידי המועמד רישיון לעריכת דין),
                            תיחשב לניסיון מקצועי רלוונטי, ככל שהוצגו הוכחות תומכות לכך.</li>
                        <li>
                            לניסיון מקצועי בתחום הכספים, ייחשב גם הניסיון שנצבר בתקופת ההתמחות בראיית חשבון.</li>
                    </ul>
                    <br><br>
                </div> --}}
                <div class="header_line faind_line">
                    מקומות עבודה קודמים
                </div>
                <div id="experience_block">
                    <div id="experience_line0" class="line">
                        <div class="inline">
                            <div class="input-control inline">
                                <div>
                                    <div class="caption bold max-w300">מקום עבודה</div>
                                    <input type="text" name="exp_position[]" class="max-440" placeholder="">
                                </div>
                            </div>
                            <div>
                                <div class="input-control inline">
                                    <div>
                                        <div class="caption bold max-w300">תאריך תחילת עבודה</div>
                                        <input type="date" name="expe_start[]" class="max-220"
                                            onchange="validateWorkExperienceDates(this)">
                                    </div>
                                </div>
                                <div class="input-control inline">
                                    <div>
                                        <div class="caption bold max-w300">תאריך סיום עבודה</div>
                                        <input type="date" name="exp_finish[]" class="max-220"
                                            onchange="validateWorkExperienceDates(this)">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="input-control inline">
                            <div>
                                <div class="caption bold max-w300">תיאור תפקיד</div>
                                <textarea type="text" name="exp_descr[]" maxlength="103" class="max-220 height-2lines" placeholder=""></textarea>
                            </div>
                        </div>
                        <div class="input-control inline">
                            <div>
                                <div class="caption bold max-w300">הסיבה להפסקת עבודה</div>
                                <textarea type="text" name="exp_reasontocomplete[]" class="max-220 height-2lines" placeholder=""></textarea>
                            </div>
                        </div>

                        <div class="input-control inline">
                            <div>
                                <div class="caption bold max-w300">היקף משרה</div>
                                <input type="text" name="exp_scope[]" class="max-440" placeholder="">
                            </div>
                        </div>
                        <div class="input-control inline file-block">
                            <div class="caption max-w300">אנא צרף.י תעודה רלוונטית <span style="margin-right: 5px;"
                                    data-toggle="tooltip"
                                    title="סוגי מסמכים מותרים הם: jpg, jpeg, doc, docx ו pdf עד 20 mb"><i
                                        class="fas fa-info-circle" aria-hidden="true"></i></span></div>

                            <?php $key = 23; ?>

                            <input type="hidden" name="vals" class="formvalsfile" value="{{ $key }}" />
                            <input type="hidden" name="valsstatic" class="formvalsfilestatic"
                                value="{{ $key }}" />
                            <?php for($z=0; $z<10; $z++,$key++){
                                $file = $form_file[$key];

                                if($z==0){
                                    $style= "";

                                }else{
                                    $style = "style=display:none";

                                }
                                // $required_val=$file['required'];
                                $required_val='';
                            ?>
                            <div id="add_file_line_{{ $key }}" class="add_file_line" {{ $style }}>
                                <div class="file-upload-row">
                                    <div class="upload-block">
                                        <a href="#" id="rcfile-upload-{{ $key }}" class="rm"
                                            style="display:none"
                                            onclick="removeFile(this,{{ $key }});return false;"><i
                                                class="trash-icon"></i></a>
                                        <input id="{{ $key }}" type="text" disabled class="btn-input-upload"
                                            value="אנא צרף.י תעודה רלוונטית" />
                                        <label for="cfile-upload-{{ $key }}" class="btn-upload ">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="19px" height="13px"
                                                style="transform: scale(0.8)  translateY(4px);">
                                                <path fill-rule="evenodd" fill="rgb(128, 184, 57)"
                                                    d="M14.537,4.008 L-0.000,4.008 L3.496,13.001 L17.666,13.001 L14.537,4.008 ZM19.000,-0.001 L13.480,-0.001 L12.375,2.000 L3.508,2.000 L3.510,2.985 L15.230,2.985 L18.725,13.001 L19.000,13.001 L19.000,-0.001 Z" />
                                            </svg>
                                            <span style="margin-top:-2px">בחר קובץ</span>
                                        </label>
                                        {{-- <input id="cfile-upload-{{$key}}" type="file" name="file[{{$key}}]"
								   onchange="fileChange(this)"
								   accept="application/pdf, image/jpeg, image/jpg, .doc,.docx, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/msword" required/> --}}
                                        <input id="cfile-upload-{{ $key }}" type="file"
                                            name="file[{{ $key }}]" onchange="fileChange(this)"
                                            accept="application/pdf" {{ $required_val }} />



                                    </div>
                                    <div class="aline">
                                        <button type="button" class="addbutton" onclick="showLineFile(this)"
                                            style="width:30px; height:30px; padding:0;">
                                            <img src="/img/icons/plus.png" />

                                        </button>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>

                        </div>
                    </div>
                </div>
            </div>


        </div>
        <div class="aline" style="flex-direction: row-reverse">
            <button type="button" class="addbutton leftbtn" onclick="showLine1()">
                <img src="/img/icons/plus.png" />
                הוספת מקום עבודה נוסף
            </button>
        </div>
        <input type="hidden" name="vals" id="formvals1" value="0" />
        <?php $sum1 = 0;
        $key = 55; ?>
        @for ($i = 1; $i < 9; $i++)
            <?php
            $req = $i < 1 ? 'required' : '';
            ?>
            <div id="experience_line_{{ $i }}" style="display:none;">
                <div class="inline" class="line">
                    <div class="input-control inline">
                        <div>
                            <div class="caption bold max-w300">מקום עבודה</div>
                            <input type="text" name="exp_position[]" class="max-440" placeholder=""
                                {{ $req }}>
                        </div>
                    </div>
                    <div>
                        <div class="input-control inline">
                            <div>
                                <div class="caption bold max-w300">תאריך תחילת עבודה</div>
                                <input type="date" name="expe_start[]" class="max-220" {{ $req }}
                                    onchange="validateWorkExperienceDates(this)">
                            </div>
                        </div>
                        <div class="input-control inline">
                            <div>
                                <div class="caption bold max-w300">תאריך סיום עבודה</div>
                                <input type="date" name="exp_finish[]" class="max-220" {{ $req }}
                                    onchange="validateWorkExperienceDates(this)">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="input-control inline">
                    <div>
                        <div class="caption bold max-w300">תיאור תפקיד</div>
                        <textarea type="text" name="exp_descr[]" maxlength="103" class="max-220 height-2lines" placeholder=""
                            {{ $req }}></textarea>
                    </div>
                </div>
                <div class="input-control inline">
                    <div>
                        <div class="caption bold max-w300">הסיבה להפסקת עבודה</div>
                        <textarea type="text" name="exp_reasontocomplete[]" class="max-220 height-2lines" placeholder=""
                            {{ $req }}></textarea>
                    </div>
                </div>
                <div class="input-control inline">
                    <div>
                        <div class="caption bold max-w300">היקף משרה</div>
                        <input type="text" name="exp_scope[]" class="max-440" placeholder="">
                    </div>
                </div>
                <div class="input-control inline file-block">
                    <div class="caption max-w300">אנא צרף תעודה רלוונטית <span style="margin-right: 5px;"
                            data-toggle="tooltip" title="סוגי מסמכים מותרים הם: jpg, jpeg, doc, docx ו pdf עד 20 mb"><i
                                class="fas fa-info-circle" aria-hidden="true"></i></span></div>

                    <?php //$key = $sum1 + 55;
                    //$sum1= $sum1+10;
                    ?>
                    <input type="hidden" name="vals" class="formvalsfile" value="{{ $key }}" />
                    <input type="hidden" name="valsstatic" class="formvalsfilestatic" value="{{ $key }}" />

                    <?php for($z=0; $z<10; $z++,$key++){
                        $file = $form_file[$key];

                        if($z==0){
                            $style= "";

                        }else{
                            $style = "style=display:none";

                        }
                        $required_val=$file['required'];
                    ?>
                    <div id="add_file_line_{{ $key }}" class="add_file_line" {{ $style }}>
                        <div class="file-upload-row">
                            <div class="upload-block">

                                <a href="#" id="rcfile-upload-{{ $key }}" class="rm"
                                    style="display:none" onclick="removeFile(this,{{ $key }});return false;"><i
                                        class="trash-icon"></i></a>
                                <input id="{{ $key }}" type="text" disabled class="btn-input-upload"
                                    value="אנא צרף תעודה רלוונטית" />
                                <label for="cfile-upload-{{ $key }}" class="btn-upload ">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="19px" height="13px" style="transform: scale(0.8)  translateY(4px);">
                                        <path fill-rule="evenodd" fill="rgb(128, 184, 57)"
                                            d="M14.537,4.008 L-0.000,4.008 L3.496,13.001 L17.666,13.001 L14.537,4.008 ZM19.000,-0.001 L13.480,-0.001 L12.375,2.000 L3.508,2.000 L3.510,2.985 L15.230,2.985 L18.725,13.001 L19.000,13.001 L19.000,-0.001 Z" />
                                    </svg>
                                    <span style="margin-top:-2px">

                                        בחר קובץ
                                    </span>
                                </label>
                                {{-- <input id="cfile-upload-{{$key}}" type="file" name="file[{{$key}}]"
								   onchange="fileChange(this)"
								   accept="application/pdf, image/jpeg, image/jpg, .doc,.docx, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/msword"/> --}}
                                <input id="cfile-upload-{{ $key }}" type="file"
                                    name="file[{{ $key }}]" onchange="fileChange(this)"
                                    accept="application/pdf" {{ $required_val }} />

                            </div>
                            <div class="aline">
                                <button type="button" class="addbutton" onclick="showLineFile(this)"
                                    style="width:30px; height:30px; padding:0;">
                                    <img src="/img/icons/plus.png" />

                                </button>
                            </div>

                        </div>
                    </div>
                    <?php } ?>
                </div>

                <div class="aline" style="flex-direction: row-reverse">
                    <a href="#" class="closebtn" style='margin-top:24px' onclick="closeLine(this)"><img
                            src="/img/close-lg.png" /></a>
                </div>
            </div>
        @endfor
        @if ($tender->has_salary)
            <div>
                <div class="header_line faind_line">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">
                            שכר
                        </font>
                    </font>
                </div>
                <div class="input-control inline">

                    @if ($tender->salary)
                        <label class="caption bold max-w300" for="salary_accept_checkbox">אני מאשר שכר זה
                            ({{ $tender->salary }})</label>

                        <label class="radio">
                            <input type="radio" value="yes" name="salary_accept" id="">
                            <span class="virtual"></span>
                            <span class="scaption">כן</span>
                        </label>

                        <label class="radio">
                            <input type="radio" value="no" name="salary_accept" id="">
                            <span class="virtual"></span>
                            <span class="scaption">לא</span>
                        </label>
                    @else
                        <label class="caption bold max-w300" for="">נא הזן את ציפיות השכר שלך</label>
                        <input type="number" name="salary" id="salary_input">
                    @endif

                </div>
            </div>
            <div>
        @endif
        <div class="header_line faind_line">
            ניסיון ניהולי רלוונטי
        </div>
        <div id="expp_block">
            <div id="expp__line0">
                <div>
                    <div class="input-control inline fg2">
                        <div>
                            <div class="caption bold max-w300">מקום עבודה</div>
                            <input type="text" name="expp_position[]" class="max-440" placeholder="">
                        </div>
                    </div>

                    <div class="input-control inline fg2">
                        <div>
                            <div class="caption bold max-w300">תפקיד</div>
                            <input type="text" name="expp_descr[]" maxlength="103" class="max-440" placeholder="">
                        </div>
                    </div>

                    <div class="input-control inline fg2">
                        <div>
                            <div class="caption bold max-w300">תאריך תחילת תקופת הניהול</div>
                            <input type="date" name="expp_pstart[]" class="max-220"
                                onchange="validateManagementExperienceDates(this)">
                        </div>
                    </div>
                    <div class="input-control inline fg2">
                        <div>
                            <div class="caption bold max-w300">תאריך סיום תקופת הניהול</div>
                            <input type="date" name="expp_finish[]" class="max-220"
                                onchange="validateManagementExperienceDates(this)">
                        </div>
                    </div>



                    <div class="input-control inline fg2">
                        <div>
                            <div class="caption bold max-w300">מספר העובדים הכפופים</div>
                            <input type="text" name="expp_employee[]" class="max-220" placeholder="">
                        </div>
                    </div>
                    <div class="input-control inline fg2">
                        <div>
                            <div class="caption bold max-w300">דרגה</div>
                            <input type="text" name="expp_level[]" class="max-150" placeholder="">
                        </div>
                    </div>



                    <div class="input-control inline file-block">
                        <div class="caption max-w300">אני צרף.י תעודה רלוונטית <span style="margin-right: 5px;"
                                data-toggle="tooltip"
                                title="סוגי מסמכים מותרים הם: jpg, jpeg, doc, docx ו pdf עד 20 mb"><i
                                    class="fas fa-info-circle" aria-hidden="true"></i></span></div>

                        <?php $key = 45; ?>
                        <input type="hidden" name="vals" class="formvalsfile" value="{{ $key }}" />
                        <input type="hidden" name="valsstatic" class="formvalsfilestatic"
                            value="{{ $key }}" />
                        <?php for($z=0; $z<10; $z++,$key++){
                            $file = $form_file[$key];

                            if($z==0){
                                $style= "";
                            }else{
                                $style = "style=display:none";

                            }

                            $required_val = $file['required'];
                        ?>
                        <div id="add_file_line_{{ $key }}" class="add_file_line" {{ $style }}>
                            <div class="file-upload-row">
                                <div class="upload-block">
                                    <a href="#" id="rcfile-upload-{{ $key }}" class="rm"
                                        style="display:none"
                                        onclick="removeFile(this,{{ $key }});return false;"><i
                                            class="trash-icon"></i></a>
                                    <input id="{{ $key }}" type="text" disabled class="btn-input-upload"
                                        value="אני צרף.י תעודה רלוונטית" />
                                    <label for="cfile-upload-{{ $key }}" class="btn-upload ">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            width="19px" height="13px"
                                            style="transform: scale(0.8)  translateY(4px);">
                                            <path fill-rule="evenodd" fill="rgb(128, 184, 57)"
                                                d="M14.537,4.008 L-0.000,4.008 L3.496,13.001 L17.666,13.001 L14.537,4.008 ZM19.000,-0.001 L13.480,-0.001 L12.375,2.000 L3.508,2.000 L3.510,2.985 L15.230,2.985 L18.725,13.001 L19.000,13.001 L19.000,-0.001 Z" />
                                        </svg>
                                        <span style="margin-top:-2px">בחר קובץ</span>
                                    </label>
                                    {{-- <input id="cfile-upload-{{$key}}" type="file" name="file[{{$key}}]"
								   onchange="fileChange(this)"
								   accept="application/pdf, image/jpeg, image/jpg, .doc,.docx, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/msword" required/> --}}
                                    <input id="cfile-upload-{{ $key }}" type="file"
                                        name="file[{{ $key }}]" onchange="fileChange(this)"
                                        accept="application/pdf" {{ $required_val }} />

                                </div>
                                <div class="aline">
                                    <button type="button" class="addbutton" onclick="showLineFile(this)"
                                        style="width:30px; height:30px; padding:0;">
                                        <img src="/img/icons/plus.png" />

                                    </button>
                                </div>
                            </div>
                        </div>
                        <?php }?>
                    </div>



                </div>
                <hr>
                {{-- <div class="faind_line" style="margin-bottom: 0;">
                        <div class="input-control inline fg2">
                            <label>
                                <span class="caption captiobblue" style="font-weight: bold;">האם עבדת ברשות מקומית
                                    בעבר?</span><br>
                                <label class="radio">
                                    <input type="radio" name="older_worker" value="yes" id="older_worker_yes"
                                        required>
                                    <span class="virtual"></span>
                                    <span class="caption">כן</span>
                                </label>
                                <label class="radio">
                                    <input type="radio" name="older_worker" value="no" required>
                                    <span class="virtual"></span>
                                    <span class="caption">לא</span>
                                </label>
                            </label>
                        </div>
                    </div> --}}
                <div class="faind_line" style="margin-bottom: 0;">
                    <div class="input-control inline fg2" data-show_type="older_worker_yes" style="">
                        <div>
                            <div class="caption max-w300">תפקיד אחרון ברשות מקומית:</div>
                            <input type="text" name="last_job" class="max-250">
                        </div>
                    </div>
                    <div class="input-control inline fg2" data-show_type="older_worker_yes" style="">
                        <div>
                            <div class="caption max-w300">תאריך התחלה:</div>
                            <input type="date" name="older_start_date" onchange="validateOlderWorkerDates(this)">
                        </div>
                    </div>
                    <div class="input-control inline fg2" data-show_type="older_worker_yes" style="">
                        <div>
                            <div class="caption max-w300">תאריך סיום:</div>
                            <input type="date" name="older_end_date" onchange="validateOlderWorkerDates(this)">
                        </div>
                    </div>
                    <div class="input-control inline fg2" data-show_type="older_worker_yes" style="">
                        <div>
                            <div class="caption max-w300">סיבת עזיבה:</div>
                            <input id="reason_for_leaving" type="text" name="reason_for_leaving" class="max-250">
                        </div>
                    </div>
                    <div class="input-control inline fg2" data-show_type="older_worker_yes" style="">
                        <div>
                            <span class="caption captiobblue" style="font-weight: bold;">עדיין עובד/ת</span>
                            <label class="radio">
                                <input type="radio" name="still_working" value="yes" id="still_working"
                                    class="not-required">
                                <span class="virtual"></span>
                                <span class="caption"></span>
                            </label>
                        </div>
                    </div>
                    <div class="header_line faind_line">השכלה</div>
                    <div class="faind_line required-c" style="display: flex;">
                        <div class="col-sm space-10">
                            <label class="checkbox">
                                <input type="checkbox" name="edu_type[]" value="השכלה תיכונית" id="edu_type1">
                                <span class="virtual"></span>
                                <span>השכלה תיכונית</span>
                            </label>
                        </div>
                        <div class="col-sm space-10">
                            <label class="checkbox">
                                <input type="checkbox" name="edu_type[]" value="השכלה על תיכונית" id="edu_type2">
                                <span class="virtual"></span>
                                <span>השכלה על תיכונית</span>
                            </label>
                        </div>
                        <div class="col-sm space-10">
                            <label class="checkbox">
                                <input type="checkbox" name="edu_type[]" value="השכלה גבוהה" id="edu_type3">
                                <span class="virtual"></span>
                                <span>השכלה גבוהה</span>
                            </label>
                        </div>
                    </div>
                    <div class="faind_line" data-show_type="edu_type1">
                        <div>
                            <br /><label class="captiobblue bold" style="margin-right:10px">השכלה
                                תיכונית</label><br />
                        </div>
                        <div id="aline1" class="aline">
                            <input type="hidden" name="educ_type_for_entry[]" value="השכלה תיכונית">
                            <div class="input-control fg2">
                                <div>
                                    <div class="caption captioblack max-w300">שם המוסד</div>
                                    <input type="text" name="educ_institution_name[]" class="mmax-220"
                                        placeholder="">
                                </div>
                            </div>
                            <div class="input-control fg2">
                                <div>
                                    <div class="caption captioblack max-w300">מגמה</div>
                                    <input type="text" name="educ_institution_mode[]" class="mmax-220"
                                        placeholder="">
                                </div>
                            </div>
                            <div class="input-control fg2">
                                <div>
                                    <div class="caption captioblack max-w300">מספר שנות לימוד</div>
                                    <input type="text" name="educ_institution_years_years[]" class="mmax-220"
                                        placeholder="">
                                </div>
                            </div>
                            <div class="input-control fg2">
                                <div>
                                    <div class="caption captioblack max-w300">שנת סיום</div>
                                    <input type="text" name="educ_last_year[]" class="mmax-220" placeholder="">
                                </div>
                            </div>

                        </div>
                         <div class="input-control fg2">
                                <div>
                                    <div class="caption max-w300">תאריך קבלת התעודה</div>
                                    <input type="date" name="educ_certificate_date[]" class="mmax-220">
                                </div>
                            </div>
                        <div>
                            <label style="margin-right:10px">תעודה/תואר</label>
                        </div>
                        <div class="required-a" style="display: flex;">
                            <div class="col-sm space-10">
                                <label class="checkbox">
                                    <input type="checkbox" name="diploma_type[]" value="בגרות">
                                    <span class="virtual"></span>
                                    <span>בגרות</span>
                                </label>
                            </div>
                            <div class="col-sm space-10">
                                <label class="checkbox">
                                    <input type="checkbox" name="diploma_type[]" value="בגרות חלקית">
                                    <span class="virtual"></span>
                                    <span>בגרות חלקית</span>
                                </label>
                            </div>
                            <div class="col-sm space-10">
                                <label class="checkbox">
                                    <input type="checkbox" name="diploma_type[]" value="גמר ללא תעודה">
                                    <span class="virtual"></span>
                                    <span>גמר ללא תעודה</span>
                                </label>
                            </div>
                            <div class="col-sm space-10">
                                <label class="checkbox">
                                    <input type="checkbox" name="diploma_type[]" value="על תיכונית">
                                    <span class="virtual"></span>
                                    <span>על תיכונית</span>
                                </label>
                            </div>
                            <div class="col-sm space-10">
                                <div class="btn-input-upload">
                                    <input multiple accept="application/pdf" type="file" name="diploma_type[]"
                                        class="d-none diploma_type" id="diploma_type">
                                    <label class="" for="diploma_type">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            width="19px" height="13px"
                                            style="transform: scale(0.8)  translateY(4px);">
                                            <path fill-rule="evenodd" fill="rgb(128, 184, 57)"
                                                d="M14.537,4.008 L-0.000,4.008 L3.496,13.001 L17.666,13.001 L14.537,4.008 ZM19.000,-0.001 L13.480,-0.001 L12.375,2.000 L3.508,2.000 L3.510,2.985 L15.230,2.985 L18.725,13.001 L19.000,13.001 L19.000,-0.001 Z" />
                                        </svg>

                                        <span class="choose-file-text" style="margin-top:-2px">
                                            בחר קובץ
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="faind_line" data-show_type="edu_type2">
                        <div>
                            <br /><label class="captiobblue bold" style="margin-right:10px">השכלה על
                                תיכונית</label><br />
                        </div>
                        <div id="aline1" class="aline">
                            <input type="hidden" name="educ_type_for_entry[]" value="השכלה על תיכונית">
                            <div class="input-control fg2">
                                <div>
                                    <div class="caption captioblack max-w300">שם המוסד</div>
                                    <input type="text" name="educ_institution_name[]" class="mmax-220"
                                        placeholder="">
                                </div>
                            </div>
                            <div class="input-control fg2">
                                <div>
                                    <div class="caption captioblack max-w300">מגמה</div>
                                    <input type="text" name="educ_institution_mode[]" class="mmax-220"
                                        placeholder="">
                                </div>
                            </div>
                            <div class="input-control fg2">
                                <div>
                                    <div class="caption captioblack max-w300">מספר שנות לימוד</div>
                                    <input type="text" name="educ_institution_years_years[]" class="mmax-220"
                                        placeholder="">
                                </div>
                            </div>
                            <div class="input-control fg2">
                                <div>
                                    <div class="caption captioblack max-w300">שנת סיום</div>
                                    <input type="text" name="educ_last_year[]" class="mmax-220" placeholder="">
                                </div>
                            </div>

                        </div>
                          <div class="input-control fg2">
                                <div>
                                    <div class="caption max-w300">תאריך קבלת התעודה</div>
                                    <input type="date" name="educ_certificate_date[]" class="mmax-220">
                                </div>
                            </div>
                        <div>
                            <label style="margin-right:10px">תעודה/תואר</label>
                        </div>
                        <div class="input-control inline fg2">
                            <label>
                                <span>תעודת גמר</span>
                                <label class="radio">
                                    <input type="radio" name="diploma_exist" value="yes">
                                    <span class="virtual"></span>
                                    <span>יש</span>
                                </label>
                                <label class="radio">
                                    <input type="radio" name="diploma_exist" value="no">
                                    <span class="virtual"></span>
                                    <span>אין</span>
                                </label>
                                <div class="btn-input-upload" style="display: inline-block;">
                                    <input multiple accept="application/pdf" type="file" name="educ_image[]"
                                        class="d-none educ_image" id="educ_image">
                                    <label class="" for="educ_image">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="19px" height="13px"
                                            style="transform: scale(0.8)  translateY(4px);">
                                            <path fill-rule="evenodd" fill="rgb(128, 184, 57)"
                                                d="M14.537,4.008 L-0.000,4.008 L3.496,13.001 L17.666,13.001 L14.537,4.008 ZM19.000,-0.001 L13.480,-0.001 L12.375,2.000 L3.508,2.000 L3.510,2.985 L15.230,2.985 L18.725,13.001 L19.000,13.001 L19.000,-0.001 Z" />
                                        </svg>

                                        <span class="choose-file-text" style="margin-top:-2px">
                                            בחר קובץ
                                        </span>
                                    </label>
                                </div>
                            </label>
                        </div>
                    </div>
                    <div class="faind_line" data-show_type="edu_type3">
                        <div id="add_educ1_block" class="add_educ_block">
                            <div id="add_edic1_line" class="add_edic_line" style="clear: both;">
                                <div>
                                    <br /><label class="captiobblue bold" style="margin-right:10px">השכלה
                                        גבוהה</label><br />
                                </div>
                                <div id="aline1" class="aline">
                                    <input type="hidden" name="educ_type_for_entry[]" value="השכלה גבוהה">
                                    <div class="input-control fg2">
                                        <div>
                                            <div class="caption captioblack max-w300">שם המוסד</div>
                                            <input type="text" name="educ_institution_name[]" class="mmax-220"
                                                placeholder="">
                                        </div>
                                    </div>
                                    <div class="input-control fg2">
                                        <div>
                                            <div class="caption captioblack max-w300">מגמה</div>
                                            <input type="text" name="educ_institution_mode[]" class="mmax-220"
                                                placeholder="">
                                        </div>
                                    </div>
                                    <div class="input-control fg2">
                                        <div>
                                            <div class="caption captioblack max-w300">מספר שנות לימוד</div>
                                            <input type="text" name="educ_institution_years_years[]"
                                                class="mmax-220" placeholder="">
                                        </div>
                                    </div>
                                    <div class="input-control fg2">
                                        <div>
                                            <div class="caption captioblack max-w300">שנת סיום</div>
                                            <input type="text" name="educ_last_year[]" class="mmax-220"
                                                placeholder="">
                                        </div>
                                    </div>

                                </div>
                                 <div class="input-control fg2">
                                        <div>
                                            <div class="caption max-w300">תאריך קבלת התעודה</div>
                                            <input type="date" name="educ_certificate_date[]" class="mmax-220">
                                        </div>
                                    </div>
                                <div>
                                    <label style="margin-right:10px">תעודה/תואר</label>
                                </div>
                                <div class="required-b">
                                    <div class="col-sm space-10" style="float: right;">
                                        <label class="checkbox">
                                            <input type="checkbox" name="diploma_high_type[]" value="תואר ראשון">
                                            <span class="virtual"></span>
                                            <span>תואר ראשון</span>
                                        </label>
                                    </div>
                                    <div class="col-sm space-10" style="float: right;">
                                        <label class="checkbox">
                                            <input type="checkbox" name="diploma_high_type[]" value="תואר שני">
                                            <span class="virtual"></span>
                                            <span>תואר שני</span>
                                        </label>
                                    </div>
                                    <div class="col-sm space-10" style="float: right;">
                                        <label class="checkbox">
                                            <input type="checkbox" name="diploma_high_type[]" value="תואר שלישי">
                                            <span class="virtual"></span>
                                            <span>תואר שלישי</span>
                                        </label>
                                    </div>

                                    <div class="col-sm space-10" style="float: right;">
                                        <label class="checkbox">
                                            <input type="checkbox" name="diploma_high_type[]" value="תעודה">
                                            <span class="virtual"></span>
                                            <span>תעודה</span>
                                        </label>
                                    </div>
                                    <div class="col-sm space-10" style="float: right;">
                                        <label class="checkbox">
                                            <input type="checkbox" name="diploma_high_type[]" value="הנדסאי">
                                            <span class="virtual"></span>
                                            <span>הנדסאי</span>
                                        </label>
                                    </div>

                                    <div class="col-sm space-10" style="float: right;">
                                        <label class="checkbox">
                                            <input type="checkbox" name="diploma_high_type[]" value="אין">
                                            <span class="virtual"></span>
                                            <span>אין</span>
                                        </label>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="aline" style="flex-direction: row-reverse;clear: both;" data-show_type="edu_type3">
                        <button type="button" class="addbutton leftbtn"
                            onclick="dublibe('add_educ1_block','add_edic1_line')">
                            <img src="/img/icons/plus.png" />
                            הוסף שורה
                        </button>
                    </div>

                    <div class="header_line faind_line">רישיון/ רישום בפנקס מקצועי</div>
                    <div class="faind_line">
                        <div class="row">
                            <div class="col-lg-2">
                                <label class="checkbox">
                                    <input type="checkbox" id="job1" name="job[1]" value="מהנדסים/אדריכלים">
                                    <span class="virtual"></span>
                                    <span class="caption">מהנדסים/אדריכלים</span>
                                </label>
                            </div>
                            <div class="col-lg-10" data-show_type="job1">
                                <div class="input-control inline fg2">
                                    <div>
                                        <div class="caption max-w180">מספר רשיון:</div>
                                        <input type="text" name="license[1]" class="max-275">
                                    </div>
                                </div>
                                <div class="input-control inline fg2">
                                    <div>
                                        <div class="caption max-w180">סוג רשיון:</div>
                                        <input type="text" name="license_type[1]" class="max-275">
                                    </div>
                                </div>
                                <div class="input-control inline fg2">
                                    <div>
                                        <div class="caption max-w180">מועד קבלת הרישיון:</div>
                                        <input type="date" name="license_date[1]" class="max-275">
                                    </div>
                                </div>
                                <div class="input-control btn-descr file-block">
                                    <div class="caption max-w300">אנא צרף צילום רישיון <span style="margin-right: 5px;"
                                            data-toggle="tooltip"
                                            title="סוגי מסמכים מותרים הם: jpg, jpeg, doc, docx ו pdf עד 20 mb"><i
                                                class="fas fa-info-circle" aria-hidden="true"></i></span></div>

                                    <?php $key = 343; ?>

                                    <input type="hidden" name="vals" class="formvalsfile"
                                        value="{{ $key }}" />
                                    <input type="hidden" name="valsstatic" class="formvalsfilestatic"
                                        value="{{ $key }}" />
                                    <?php for($z=0; $z<1; $z++,$key++){
	$file = $form_file[$key];

	if($z==0){
		$style= "";
	}else{
		$style = "style=display:none";

	}

	$required_val = $file['required'];



        ?>
                                    <div id="add_file_line_{{ $key }}" class="add_file_line"
                                        {{ $style }}>
                                        <div class="file-upload-row">
                                            <div class="upload-block">
                                                <a href="#" id="rcfile-upload-{{ $key }}"
                                                    class="rm" style="display:none"
                                                    onclick="removeFile(this,{{ $key }});return false;"><i
                                                        class="trash-icon"></i></a>
                                                <input id="{{ $key }}" type="text" disabled
                                                    class="btn-input-upload" value="אנא צרף תעודה רלוונטית" />
                                                <label for="cfile-upload-{{ $key }}" class="btn-upload ">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="19px"
                                                        height="13px" style="transform: scale(0.8)  translateY(4px);">
                                                        <path fill-rule="evenodd" fill="rgb(128, 184, 57)"
                                                            d="M14.537,4.008 L-0.000,4.008 L3.496,13.001 L17.666,13.001 L14.537,4.008 ZM19.000,-0.001 L13.480,-0.001 L12.375,2.000 L3.508,2.000 L3.510,2.985 L15.230,2.985 L18.725,13.001 L19.000,13.001 L19.000,-0.001 Z" />
                                                    </svg>
                                                    <span style="margin-top:-2px">
                                                        בחר קובץ
                                                    </span>
                                                </label>
                                                {{-- <input id="cfile-upload-{{$key}}" type="file" name="file[{{$key}}]"
								   onchange="fileChange(this)"
								   accept="application/pdf, image/jpeg, image/jpg, .doc,.docx, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/msword"/> --}}
                                                <input id="cfile-upload-{{ $key }}" type="file"
                                                    name="file[{{ $key }}]" onchange="fileChange(this)"
                                                    accept="application/pdf, image/jpeg, image/jpg, .doc,.docx, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/msword" />
                                            </div>

                                        </div>
                                    </div>
                                    <?php } ?>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2">
                                <label class="checkbox">
                                    <input type="checkbox" id="job2" name="job[2]" value="טכנאים/הנדסאים">
                                    <span class="virtual"></span>
                                    <span class="caption">טכנאים/הנדסאים</span>
                                </label>
                            </div>
                            <div class="col-lg-10" data-show_type="job2">
                                <div class="input-control inline fg2">
                                    <div>
                                        <div class="caption max-w180">מספר רשיון:</div>
                                        <input type="text" name="license[2]" class="max-275">
                                    </div>
                                </div>
                                <div class="input-control inline fg2">
                                    <div>
                                        <div class="caption max-w180">סוג רשיון:</div>
                                        <input type="text" name="license_type[2]" class="max-275">
                                    </div>
                                </div>
                                <div class="input-control inline fg2">
                                    <div>
                                        <div class="caption max-w180">מועד קבלת הרישיון:</div>
                                        <input type="date" name="license_date[2]" class="max-275">
                                    </div>
                                </div>
                                <div class="input-control btn-descr file-block">
                                    <div class="caption max-w300">אנא צרף צילום רישיון <span style="margin-right: 5px;"
                                            data-toggle="tooltip"
                                            title="סוגי מסמכים מותרים הם: jpg, jpeg, doc, docx ו pdf עד 20 mb"><i
                                                class="fas fa-info-circle" aria-hidden="true"></i></span></div>
                                    <?php $key = 353; ?>

                                    <input type="hidden" name="vals" class="formvalsfile"
                                        value="{{ $key }}" />
                                    <input type="hidden" name="valsstatic" class="formvalsfilestatic"
                                        value="{{ $key }}" />
                                    <?php for($z=0; $z<1; $z++,$key++){
	$file = $form_file[$key];

	if($z==0){
		$style= "";
	}else{
		$style = "style=display:none";

	}

	$required_val = $file['required'];



        ?>
                                    <div id="add_file_line_{{ $key }}" class="add_file_line"
                                        {{ $style }}>
                                        <div class="file-upload-row">
                                            <div class="upload-block">
                                                <a href="#" id="rcfile-upload-{{ $key }}"
                                                    class="rm" style="display:none"
                                                    onclick="removeFile(this,{{ $key }});return false;"><i
                                                        class="trash-icon"></i></a>
                                                <input id="{{ $key }}" type="text" disabled
                                                    class="btn-input-upload" value="אנא צרף תעודה רלוונטית" />
                                                <label for="cfile-upload-{{ $key }}" class="btn-upload ">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="19px"
                                                        height="13px" style="transform: scale(0.8)  translateY(4px);">
                                                        <path fill-rule="evenodd" fill="rgb(128, 184, 57)"
                                                            d="M14.537,4.008 L-0.000,4.008 L3.496,13.001 L17.666,13.001 L14.537,4.008 ZM19.000,-0.001 L13.480,-0.001 L12.375,2.000 L3.508,2.000 L3.510,2.985 L15.230,2.985 L18.725,13.001 L19.000,13.001 L19.000,-0.001 Z" />
                                                    </svg>
                                                    <span style="margin-top:-2px">

                                                        בחר קובץ
                                                    </span>
                                                </label>
                                                {{-- <input id="cfile-upload-72" type="file" name="file[72]"
								   onchange="fileChange(this)"
								   accept="application/pdf, image/jpeg, image/jpg, .doc,.docx, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/msword"/> --}}
                                                <input id="cfile-upload-{{ $key }}" type="file"
                                                    name="file[{{ $key }}]" onchange="fileChange(this)"
                                                    accept="application/pdf" />

                                            </div>
                                            {{-- <div class="aline"  >
			<button type="button" class="addbutton" onclick="showLineFile(this)" style="width:30px; height:30px; padding:0;">
				<img src="/img/icons/plus.png"  />

			</button>
		</div> --}}
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2">
                                <label class="checkbox">
                                    <input type="checkbox" id="job3" name="job[3]" value="עובדים סוציאליים">
                                    <span class="virtual"></span>
                                    <span class="caption">עובדים סוציאליים</span>
                                </label>
                            </div>
                            <div class="col-lg-10" data-show_type="job3">
                                <div class="input-control inline fg2">
                                    <div>
                                        <div class="caption max-w180">מספר רשיון:</div>
                                        <input type="text" name="license[3]" class="max-275">
                                    </div>
                                </div>
                                <div class="input-control inline fg2">
                                    <div>
                                        <div class="caption max-w180">סוג רשיון:</div>
                                        <input type="text" name="license_type[3]" class="max-275">
                                    </div>
                                </div>
                                <div class="input-control inline fg2">
                                    <div>
                                        <div class="caption max-w180">מועד קבלת הרישיון:</div>
                                        <input type="date" name="license_date[3]" class="max-275">
                                    </div>
                                </div>
                                <div class="input-control btn-descr file-block">
                                    <div class="caption max-w300">אנא צרף צילום רישיון <span style="margin-right: 5px;"
                                            data-toggle="tooltip"
                                            title="סוגי מסמכים מותרים הם: jpg, jpeg, doc, docx ו pdf עד 20 mb"><i
                                                class="fas fa-info-circle" aria-hidden="true"></i></span></div>
                                    <?php $key = 363; ?>

                                    <input type="hidden" name="vals" class="formvalsfile"
                                        value="{{ $key }}" />
                                    <input type="hidden" name="valsstatic" class="formvalsfilestatic"
                                        value="{{ $key }}" />
                                    <?php for($z=0; $z<1; $z++,$key++){
	$file = $form_file[$key];

	if($z==0){
		$style= "";
	}else{
		$style = "style=display:none";

	}

	$required_val = $file['required'];



        ?>
                                    <div id="add_file_line_{{ $key }}" class="add_file_line"
                                        {{ $style }}>
                                        <div class="file-upload-row">
                                            <div class="upload-block">
                                                <a href="#" id="rcfile-upload-{{ $key }}"
                                                    class="rm" style="display:none"
                                                    onclick="removeFile(this,{{ $key }});return false;"><i
                                                        class="trash-icon"></i></a>
                                                <input id="{{ $key }}" type="text" disabled
                                                    class="btn-input-upload" value="אנא צרף תעודה רלוונטית" />
                                                <label for="cfile-upload-{{ $key }}" class="btn-upload ">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="19px"
                                                        height="13px" style="transform: scale(0.8)  translateY(4px);">
                                                        <path fill-rule="evenodd" fill="rgb(128, 184, 57)"
                                                            d="M14.537,4.008 L-0.000,4.008 L3.496,13.001 L17.666,13.001 L14.537,4.008 ZM19.000,-0.001 L13.480,-0.001 L12.375,2.000 L3.508,2.000 L3.510,2.985 L15.230,2.985 L18.725,13.001 L19.000,13.001 L19.000,-0.001 Z" />
                                                    </svg>
                                                    <span style="margin-top:-2px">

                                                        בחר קובץ
                                                    </span>
                                                </label>
                                                {{-- <input id="cfile-upload-73" type="file" name="file[73]"
								   onchange="fileChange(this)"
								   accept="application/pdf, image/jpeg, image/jpg, .doc,.docx, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/msword"/> --}}
                                                <input id="cfile-upload-{{ $key }}" type="file"
                                                    name="file[{{ $key }}]" onchange="fileChange(this)"
                                                    accept="application/pdf, image/jpeg, image/jpg, .doc,.docx, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/msword" />
                                            </div>
                                            {{-- <div class="aline"  >
			<button type="button" class="addbutton" onclick="showLineFile(this)" style="width:30px; height:30px; padding:0;">
				<img src="/img/icons/plus.png"  />

			</button>
		</div> --}}
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>


                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2">
                                <label class="checkbox">
                                    <input type="checkbox" id="job4" name="job[4]" value="עריכת דין">
                                    <span class="virtual"></span>
                                    <span class="caption">עריכת דין</span>
                                </label>
                            </div>
                            <div class="col-lg-10" data-show_type="job4">
                                <div class="input-control inline fg2">
                                    <div>
                                        <div class="caption max-w180">מספר רשיון:</div>
                                        <input type="text" name="license[4]" class="max-275">
                                    </div>
                                </div>
                                <div class="input-control inline fg2">
                                    <div>
                                        <div class="caption max-w180">סוג רשיון:</div>
                                        <input type="text" name="license_type[4]" class="max-275">
                                    </div>
                                </div>
                                <div class="input-control inline fg2">
                                    <div>
                                        <div class="caption max-w180">מועד קבלת הרישיון:</div>
                                        <input type="date" name="license_date[4]" class="max-275">
                                    </div>
                                </div>
                                <div class="input-control btn-descr">
                                    <div class="caption max-w300">אנא צרף צילום רישיון <span style="margin-right: 5px;"
                                            data-toggle="tooltip"
                                            title="סוגי מסמכים מותרים הם: jpg, jpeg, doc, docx ו pdf עד 20 mb"><i
                                                class="fas fa-info-circle" aria-hidden="true"></i></span></div>
                                    <div>
                                        <div class="upload-block">
                                            <a href="#" id="rcfile-upload-373" class="rm"
                                                style="display:none" onclick="removeFile(this,74);return false;"><i
                                                    class="trash-icon"></i></a>
                                            <input id="373" type="text" disabled class="btn-input-upload"
                                                value="אנא צרף תעודה רלוונטית" />
                                            <label for="cfile-upload-373" class="btn-upload ">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="19px"
                                                    height="13px" style="transform: scale(0.8)  translateY(4px);">
                                                    <path fill-rule="evenodd" fill="rgb(128, 184, 57)"
                                                        d="M14.537,4.008 L-0.000,4.008 L3.496,13.001 L17.666,13.001 L14.537,4.008 ZM19.000,-0.001 L13.480,-0.001 L12.375,2.000 L3.508,2.000 L3.510,2.985 L15.230,2.985 L18.725,13.001 L19.000,13.001 L19.000,-0.001 Z" />
                                                </svg>
                                                <span style="margin-top:-2px">

                                                    בחר קובץ
                                                </span>
                                            </label>
                                            {{-- <input id="cfile-upload-74" type="file" name="file[74]"
								   onchange="fileChange(this)"
								   accept="application/pdf, image/jpeg, image/jpg, .doc,.docx, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/msword"/> --}}
                                            <input id="cfile-upload-373" type="file" name="file[373]"
                                                onchange="fileChange(this)" accept="application/pdf" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2">
                                <label class="checkbox">
                                    <input type="checkbox" id="job5" name="job[5]" value="ראיית חשבון">
                                    <span class="virtual"></span>
                                    <span class="caption">ראיית חשבון</span>
                                </label>
                            </div>
                            <div class="col-lg-10" data-show_type="job5">
                                <div class="input-control inline fg2">
                                    <div>
                                        <div class="caption max-w180">מספר רשיון:</div>
                                        <input type="text" name="license[5]" class="max-275">
                                    </div>
                                </div>
                                <div class="input-control inline fg2">
                                    <div>
                                        <div class="caption max-w180">סוג רשיון:</div>
                                        <input type="text" name="license_type[5]" class="max-275">
                                    </div>
                                </div>
                                <div class="input-control inline fg2">
                                    <div>
                                        <div class="caption max-w180">מועד קבלת הרישיון:</div>
                                        <input type="date" name="license_date[5]" class="max-275">
                                    </div>
                                </div>
                                <div class="input-control btn-descr">
                                    <div class="caption max-w300">אנא צרף צילום רישיון <span style="margin-right: 5px;"
                                            data-toggle="tooltip"
                                            title="סוגי מסמכים מותרים הם: jpg, jpeg, doc, docx ו pdf עד 20 mb"><i
                                                class="fas fa-info-circle" aria-hidden="true"></i></span></div>
                                    <div>
                                        <div class="upload-block">
                                            <a href="#" id="rcfile-upload-383" class="rm"
                                                style="display:none" onclick="removeFile(this,383);return false;"><i
                                                    class="trash-icon"></i></a>
                                            <input id="383" type="text" disabled class="btn-input-upload"
                                                value="אנא צרף תעודה רלוונטית" />
                                            <label for="cfile-upload-383" class="btn-upload ">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="19px"
                                                    height="13px" style="transform: scale(0.8)  translateY(4px);">
                                                    <path fill-rule="evenodd" fill="rgb(128, 184, 57)"
                                                        d="M14.537,4.008 L-0.000,4.008 L3.496,13.001 L17.666,13.001 L14.537,4.008 ZM19.000,-0.001 L13.480,-0.001 L12.375,2.000 L3.508,2.000 L3.510,2.985 L15.230,2.985 L18.725,13.001 L19.000,13.001 L19.000,-0.001 Z" />
                                                </svg>
                                                <span style="margin-top:-2px">

                                                    בחר קובץ
                                                </span>
                                            </label>
                                            {{-- <input id="cfile-upload-75" type="file" name="file[75]"
								   onchange="fileChange(this)"
								   accept="application/pdf, image/jpeg, image/jpg, .doc,.docx, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/msword"/> --}}
                                            <input id="cfile-upload-383" type="file" name="file[383]"
                                                onchange="fileChange(this)" accept="application/pdf" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2">
                                <label class="checkbox">
                                    <input type="checkbox" id="job6" name="job[6]" value="אחיות">
                                    <span class="virtual"></span>
                                    <span class="caption">אחיות</span>
                                </label>
                            </div>
                            <div class="col-lg-10" data-show_type="job6">
                                <div class="input-control inline fg2">
                                    <div>
                                        <div class="caption max-w180">מספר רשיון:</div>
                                        <input type="text" name="license[6]" class="max-275">
                                    </div>
                                </div>
                                <div class="input-control inline fg2">
                                    <div>
                                        <div class="caption max-w180">סוג רשיון:</div>
                                        <input type="text" name="license_type[6]" class="max-275">
                                    </div>
                                </div>
                                <div class="input-control inline fg2">
                                    <div>
                                        <div class="caption max-w180">מועד קבלת הרישיון:</div>
                                        <input type="date" name="license_date[6]" class="max-275">
                                    </div>
                                </div>
                                <div class="input-control btn-descr">
                                    <div class="caption max-w300">אנא צרף צילום רישיון <span style="margin-right: 5px;"
                                            data-toggle="tooltip"
                                            title="סוגי מסמכים מותרים הם: jpg, jpeg, doc, docx ו pdf עד 20 mb"><i
                                                class="fas fa-info-circle" aria-hidden="true"></i></span></div>
                                    <div>
                                        <div class="upload-block">
                                            <a href="#" id="rcfile-upload-393" class="rm"
                                                style="display:none" onclick="removeFile(this,393);return false;"><i
                                                    class="trash-icon"></i></a>
                                            <input id="393" type="text" disabled class="btn-input-upload"
                                                value="אנא צרף תעודה רלוונטית" />
                                            <label for="cfile-upload-393" class="btn-upload ">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="19px"
                                                    height="13px" style="transform: scale(0.8)  translateY(4px);">
                                                    <path fill-rule="evenodd" fill="rgb(128, 184, 57)"
                                                        d="M14.537,4.008 L-0.000,4.008 L3.496,13.001 L17.666,13.001 L14.537,4.008 ZM19.000,-0.001 L13.480,-0.001 L12.375,2.000 L3.508,2.000 L3.510,2.985 L15.230,2.985 L18.725,13.001 L19.000,13.001 L19.000,-0.001 Z" />
                                                </svg>
                                                <span style="margin-top:-2px">

                                                    בחר קובץ
                                                </span>
                                            </label>
                                            {{-- <input id="cfile-upload-76" type="file" name="file[76]"
								   onchange="fileChange(this)"
								   accept="application/pdf, image/jpeg, image/jpg, .doc,.docx, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/msword"/> --}}
                                            <input id="cfile-upload-393" type="file" name="file[393]"
                                                onchange="fileChange(this)" accept="application/pdf" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2">
                                <label class="checkbox">
                                    <input type="checkbox" id="job7" name="job[7]" value="רפואה">
                                    <span class="virtual"></span>
                                    <span class="caption">רפואה</span>
                                </label>
                            </div>
                            <div class="col-lg-10" data-show_type="job7">
                                <div class="input-control inline fg2">
                                    <div>
                                        <div class="caption max-w180">מספר רשיון:</div>
                                        <input type="text" name="license[7]" class="max-275">
                                    </div>
                                </div>
                                <div class="input-control inline fg2">
                                    <div>
                                        <div class="caption max-w180">סוג רשיון:</div>
                                        <input type="text" name="license_type[7]" class="max-275">
                                    </div>
                                </div>
                                <div class="input-control inline fg2">
                                    <div>
                                        <div class="caption max-w180">מועד קבלת הרישיון:</div>
                                        <input type="date" name="license_date[7]" class="max-275">
                                    </div>
                                </div>
                                <div class="input-control btn-descr">
                                    <div class="caption max-w300">אנא צרף צילום רישיון <span style="margin-right: 5px;"
                                            data-toggle="tooltip"
                                            title="סוגי מסמכים מותרים הם: jpg, jpeg, doc, docx ו pdf עד 20 mb"><i
                                                class="fas fa-info-circle" aria-hidden="true"></i></span></div>
                                    <div>
                                        <div class="upload-block">
                                            <a href="#" id="rcfile-upload-403" class="rm"
                                                style="display:none" onclick="removeFile(this,77);return false;"><i
                                                    class="trash-icon"></i></a>
                                            <input id="403" type="text" disabled class="btn-input-upload"
                                                value="אנא צרף תעודה רלוונטית" />
                                            <label for="cfile-upload-403" class="btn-upload ">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="19px"
                                                    height="13px" style="transform: scale(0.8)  translateY(4px);">
                                                    <path fill-rule="evenodd" fill="rgb(128, 184, 57)"
                                                        d="M14.537,4.008 L-0.000,4.008 L3.496,13.001 L17.666,13.001 L14.537,4.008 ZM19.000,-0.001 L13.480,-0.001 L12.375,2.000 L3.508,2.000 L3.510,2.985 L15.230,2.985 L18.725,13.001 L19.000,13.001 L19.000,-0.001 Z" />
                                                </svg>
                                                <span style="margin-top:-2px">

                                                    בחר קובץ
                                                </span>
                                            </label>
                                            {{-- <input id="cfile-upload-403" type="file" name="file[403]"
								   onchange="fileChange(this)"
								   accept="application/pdf, image/jpeg, image/jpg, .doc,.docx, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/msword"/> --}}
                                            <input id="cfile-upload-403" type="file" name="file[403]"
                                                onchange="fileChange(this)" accept="application/pdf" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2">
                                <label class="checkbox">
                                    <input type="checkbox" id="job8" name="job[8]" value="תעודת רישיון אחר">
                                    <span class="virtual"></span>
                                    <span class="caption">תעודת רישיון אחר</span>
                                </label>
                            </div>
                            <div class="col-lg-10" data-show_type="job8">
                                <div class="input-control inline fg2">
                                    <div>
                                        <div class="caption max-w180">מספר רשיון:</div>
                                        <input type="text" name="license[8]" class="max-275">
                                    </div>
                                </div>
                                <div class="input-control inline fg2">
                                    <div>
                                        <div class="caption max-w180">סוג רשיון:</div>
                                        <input type="text" name="license_type[8]" class="max-275">
                                    </div>
                                </div>
                                <div class="input-control inline fg2">
                                    <div>
                                        <div class="caption max-w180">מועד קבלת הרישיון:</div>
                                        <input type="date" name="license_date[8]" class="max-275">
                                    </div>
                                </div>
                                <div class="input-control btn-descr">
                                    <div class="caption max-w300">אנא צרף צילום רישיון <span style="margin-right: 5px;"
                                            data-toggle="tooltip"
                                            title="סוגי מסמכים מותרים הם: jpg, jpeg, doc, docx ו pdf עד 20 mb"><i
                                                class="fas fa-info-circle" aria-hidden="true"></i></span></div>
                                    <div>
                                        <div class="upload-block">
                                            <a href="#" id="rcfile-upload-413" class="rm"
                                                style="display:none" onclick="removeFile(this,413);return false;"><i
                                                    class="trash-icon"></i></a>
                                            <input id="413" type="text" disabled class="btn-input-upload"
                                                value="אנא צרף תעודה רלוונטית" />
                                            <label for="cfile-upload-413" class="btn-upload ">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="19px"
                                                    height="13px" style="transform: scale(0.8)  translateY(4px);">
                                                    <path fill-rule="evenodd" fill="rgb(128, 184, 57)"
                                                        d="M14.537,4.008 L-0.000,4.008 L3.496,13.001 L17.666,13.001 L14.537,4.008 ZM19.000,-0.001 L13.480,-0.001 L12.375,2.000 L3.508,2.000 L3.510,2.985 L15.230,2.985 L18.725,13.001 L19.000,13.001 L19.000,-0.001 Z" />
                                                </svg>
                                                <span style="margin-top:-2px">

                                                    בחר קובץ
                                                </span>
                                            </label>
                                            {{-- <input id="cfile-upload-413" type="file" name="file[413]"
								   onchange="fileChange(this)"
								   accept="application/pdf, image/jpeg, image/jpg, .doc,.docx, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/msword"/> --}}
                                            <input id="cfile-upload-413" type="file" name="file[413]"
                                                onchange="fileChange(this)" accept="application/pdf" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="header_line faind_line">רשיונות נהיגה/בעלות על רכב</div> --}}
                <div class="faind_line" style="display: flex;">
                    {{-- <div class="input-control inline fg2">
                                <label>
                                    <div class="caption bold">רשיונות נהיגה</div>
                                    <label class="radio">
                                        <input type="radio" name="license_exist" value="yes" required="true"
                                            id="license_exist_yes">
                                        <span class="virtual"></span>
                                        <span>יש</span>
                                    </label>
                                    <label class="radio">
                                        <input type="radio" name="license_exist" value="no" required="true">
                                        <span class="virtual"></span>
                                        <span>אין</span>
                                    </label>
                                </label>
                            </div>
                            <div class="input-control inline fg2">
                                <label>
                                    <div class="caption bold">בעלות על רכב</div>
                                    <label class="radio">
                                        <input type="radio" name="car_exist" value="yes" required="true">
                                        <span class="virtual"></span>
                                        <span>יש</span>
                                    </label>
                                    <label class="radio">
                                        <input type="radio" name="car_exist" value="no" required="true">
                                        <span class="virtual"></span>
                                        <span>אין</span>
                                    </label>
                                </label>
                            </div> --}}
                    <div class="input-control inline fg2">
                        <!--<label>
                                                                                                                                                                        <div class="caption bold">סוג הרשיון</div>
                                                                                                                                                                        <select name="car_license_type" multiple>
                                                                                                                                                                         <option></option>
                                                                                                                                                                         <option value="a">אופנוע</option>
                                                                                                                                                                         <option value="b">רכב עד 3.5 טון ועד 8 נוסעים</option>
                                                                                                                                                                         <option value="c">רכב משא</option>
                                                                                                                                                                         <option value="d">אוטובוסים ומוניות</option>
                                                                                                                                                                         <option value="1">טרקטור</option>
                                                                                                                                                                        </select>
                                                                                                                                                                       </label>-->

                        {{-- <div>
                                    <div class="caption bold">סוג הרשיון</div>
                                    <label class="checkbox" style="margin-left: 10px; margin-top: 0;">
                                        <input type="checkbox" name="car_license_type[]" value="אופנוע">
                                        <span class="virtual"></span>
                                        <span class="caption">אופנוע</span>
                                    </label>
                                    <label class="checkbox" style="margin-left: 10px; margin-top: 0;">
                                        <input type="checkbox" name="car_license_type[]"
                                            value="רכב עד 3.5 טון ועד 8 נוסעים">
                                        <span class="virtual"></span>
                                        <span class="caption">רכב עד 3.5 טון ועד 8 נוסעים</span>
                                    </label>
                                    <label class="checkbox" style="margin-left: 10px; margin-top: 0;">
                                        <input type="checkbox" name="car_license_type[]" value="רכב משא">
                                        <span class="virtual"></span>
                                        <span class="caption">רכב משא</span>
                                    </label>
                                    <label class="checkbox" style="margin-left: 10px; margin-top: 0;">
                                        <input type="checkbox" name="car_license_type[]" value="אוטובוסים ומוניות">
                                        <span class="virtual"></span>
                                        <span class="caption">אוטובוסים ומוניות</span>
                                    </label>
                                    <label class="checkbox" style="margin-left: 10px; margin-top: 0;">
                                        <input type="checkbox" name="car_license_type[]" value="טרקטור">
                                        <span class="virtual"></span>
                                        <span class="caption">טרקטור</span>
                                    </label>
                                </div> --}}
                    </div>
                </div>
                <div class="header_line faind_line">
                    והשתלמויות קורסים
                </div>
                <div class="faind_line">
                    <div style="display: flex; flex-wrap: wrap; gap: 10px; align-items: end;">
                        <div class="input-control inline" style="flex: 1; min-width: 180px;">
                            <div>
                                <div class="caption max-w300">שם הקורס</div>
                                <input type="text" name="course_name" class="max-220" placeholder="">
                            </div>
                        </div>
                        <div class="input-control inline" style="flex: 1; min-width: 150px;">
                            <div>
                                <div class="caption max-w300">מתאריך</div>
                                <input type="date" name="start_date" class="max-220" placeholder=""
                                    onchange="validateCourseDates(this)">
                            </div>
                        </div>
                        <div class="input-control inline" style="flex: 1; min-width: 150px;">
                            <div>
                                <div class="caption max-w300">עד תאריך</div>
                                <input type="date" name="end_date" class="max-220" placeholder=""
                                    onchange="validateCourseDates(this)">
                            </div>
                        </div>
                        <div class="input-control inline" style="flex: 1; min-width: 180px;">
                            <div>
                                <div class="caption max-w300">מסגרת הלימודים</div>
                                <input type="text" name="study_framework" class="max-220" placeholder="">
                            </div>
                        </div>
                        <div class="input-control inline" style="flex: 1; min-width: 120px;">
                            <div>
                                <div class="caption max-w300">תעודת גמר</div>
                                <input type="text" name="certificate" class="max-220" placeholder="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="header_line faind_line">
                    שפות
                </div>
                <div class="faind_line">
                    <div id="ivrblock" style="">
                        {{-- <div class="input-control inline">
                                <div>
                                    <div class="caption max-w300">השפה</div>
                                    <select name="language[]" class="max-220" required="">
                                        <option value="עברית" selected>עברית</option>
                                        <option value="אנגלית" >אנגלית</option>
                                    </select>
                                </div>
                            </div> --}}
                        <div class="input-control inline">
                            <div>
                                <div class="caption max-w300">השפה</div>
                                <input type="text" value="עברית" class="max-220" disabled placeholder="עברית">
                                <input type="hidden" name="language[]" value="עברית" class="max-220"
                                    placeholder="">
                            </div>
                        </div>
                        <div class="input-control inline" id="id1">
                            <div>
                                <div class="caption max-w300">קריאה</div>
                                <select name="language_read_[]" class="max-220" required="">
                                    <option></option>
                                    <option value="שליטה מלאה">שליטה מלאה</option>
                                    <option value="שליטה חלקית">שליטה חלקית</option>
                                    <option value="חוסר שליטה">חוסר שליטה</option>
                                </select>
                            </div>
                        </div>
                        <div class="input-control inline" id="id2">
                            <div>
                                <div class="caption max-w300">כתיבה</div>
                                <select name="language_write_[]" class="max-220" required="">
                                    <option></option>
                                    <option value="שליטה מלאה">שליטה מלאה</option>
                                    <option value="שליטה חלקית">שליטה חלקית</option>
                                    <option value="חוסר שליטה">חוסר שליטה</option>
                                </select>
                            </div>
                        </div>
                        <div class="input-control inline">
                            <div>
                                <div class="caption max-w300">דיבור</div>
                                <select name="language_speak_[]" class="max-220" required="">
                                    <option></option>
                                    <option value="שליטה מלאה">שליטה מלאה</option>
                                    <option value="שליטה חלקית">שליטה חלקית</option>
                                    <option value="חוסר שליטה">חוסר שליטה</option>
                                </select>
                            </div>
                        </div>
                        <a href="#" class="closebtn" style='visibility:hidden;margin-top:25px'
                            onclick="closeLine(this)"><img src="/img/close-lg.png" /></a>

                    </div>
                    <div id="eblock">
                        <div class="input-control inline">
                            <div>
                                <div class="caption max-w300">השפה</div>
                                <input type="text" value="אנגלית" class="max-220" placeholder="אנגלית">
                                <input type="hidden" name="language[]" value="אנגלית">
                            </div>
                        </div>
                        <div class="input-control inline">
                            <div>
                                <div class="caption max-w300">קריאה</div>
                                <select name="language_read_[]" class="max-220" required="">
                                    <option></option>
                                    <option value="שליטה מלאה">שליטה מלאה</option>
                                    <option value="שליטה חלקית">שליטה חלקית</option>
                                    <option value="חוסר שליטה">חוסר שליטה</option>
                                </select>
                            </div>
                        </div>
                        <div class="input-control inline">
                            <div>
                                <div class="caption max-w300">כתיבה</div>
                                <select name="language_write_[]" class="max-220" required="">
                                    <option></option>
                                    <option value="שליטה מלאה">שליטה מלאה</option>
                                    <option value="שליטה חלקית">שליטה חלקית</option>
                                    <option value="חוסר שליטה">חוסר שליטה</option>
                                </select>

                            </div>
                        </div>
                        <div class="input-control inline">
                            <div>
                                <div class="caption max-w300">דיבור</div>
                                <select name="language_speak_[]" class="max-220" required="">
                                    <option></option>
                                    <option value="שליטה מלאה">שליטה מלאה</option>
                                    <option value="שליטה חלקית">שליטה חלקית</option>
                                    <option value="חוסר שליטה">חוסר שליטה</option>
                                </select>
                            </div>
                        </div>
                        <a href="#" class="closebtn" style='visibility:hidden;margin-top:25px'
                            onclick="closeLine(this)"><img src="/img/close-lg.png" /></a>

                    </div>
                    <div class="language_block" id="language_block">
                        <div id="language_line" style="display:none">

                            <div class="input-control inline">
                                <div>
                                    <div class="caption max-w300">השפה</div>
                                    <input type="text" name="language[]" class="max-220" placeholder="">
                                </div>
                            </div>
                            <div class="input-control inline">
                                <div>
                                    <div class="caption max-w300">קריאה</div>
                                    <select name="language_read_[]" class="max-220">
                                        <option></option>
                                        <option value="שליטה מלאה">שליטה מלאה</option>
                                        <option value="שליטה חלקית">שליטה חלקית</option>
                                        <option value="חוסר שליטה">חוסר שליטה</option>
                                    </select>
                                </div>
                            </div>
                            <div class="input-control inline">
                                <div>
                                    <div class="caption max-w300">כתיבה</div>
                                    <select name="language_write_[]" class="max-220">
                                        <option></option>
                                        <option value="שליטה מלאה">שליטה מלאה</option>
                                        <option value="שליטה חלקית">שליטה חלקית</option>
                                        <option value="חוסר שליטה">חוסר שליטה</option>
                                    </select>
                                </div>
                            </div>
                            <div class="input-control inline">
                                <div>
                                    <div class="caption max-w300">דיבור</div>

                                    <select name="language_speak_[]" class="max-220">
                                        <option></option>
                                        <option value="שליטה מלאה">שליטה מלאה</option>
                                        <option value="שליטה חלקית">שליטה חלקית</option>
                                        <option value="חוסר שליטה">חוסר שליטה</option>
                                    </select>
                                </div>
                            </div>
                            <a href="#" class="closebtn" style='visibility:hidden;margin-top:25px'
                                onclick="closeLine(this)"><img src="/img/close-lg.png" /></a>
                        </div>
                    </div>
                </div>
                <div class="aline" style="flex-direction: row-reverse">
                    <div class="input-control leftbtn">
                        <button type="button" class="addbutton" onclick="dublibe('language_block','language_line')">
                            <img src="/img/icons/plus.png" />
                            הוסף שורה
                        </button>
                    </div>
                </div>

                <div class="header_line faind_line">
                    שמות ממליצים:
                </div>
                <div class="faind_line">
                    <div style="display: flex; flex-wrap: wrap; gap: 10px; align-items: end;">
                        <div class="input-control inline" style="flex: 1; min-width: 180px;">
                            <div>
                                <div class="caption max-w300">שם ושם משפחה</div>
                                <input type="text" name="recomendations_full_name_z[]" pattern="^[a-zA-Zא-ת\s]+$"
                                    class="max-220" placeholder="">
                            </div>
                        </div>
                        <div class="input-control inline" style="flex: 1; min-width: 150px;">
                            <div>
                                <div class="caption max-w300">שם משפחה</div>
                                <input type="text" name="recomendations_last_name_z[]" pattern="^[a-zA-Zא-ת\s]+$"
                                    class="max-220" placeholder="">
                            </div>
                        </div>
                        <div class="input-control inline" style="flex: 1; min-width: 150px;">
                            <div>
                                <div class="caption max-w300">תפקיד/ מקצוע</div>
                                <input type="text" name="recomendations_role_z[]" pattern="^[a-zA-Zא-ת\s]+$"
                                    class="max-220" placeholder="">
                            </div>
                        </div>
                        <div class="input-control inline" style="flex: 1; min-width: 180px;">
                            <div>
                                <div class="caption max-w300">כתובת</div>
                                <input type="text" name="recomendations_address_z[]"
                                    pattern="^[a-zA-Zא-ת0-9\s,.-]+$" class="max-220" placeholder="">
                            </div>
                        </div>
                        <div class="input-control inline" style="flex: 1; min-width: 120px;">
                            <div>
                                <div class="caption max-w300">טלפון</div>
                                <input type="text" name="recomendations_phone_z[]" pattern="^[0-9-]+$"
                                    class="max-220" placeholder="">
                            </div>
                        </div>
                        <a href="#" class="closebtn" style='visibility:hidden;margin-top:25px'
                            onclick="closeLine(this)"><img src="/img/close-lg.png" /></a>

                    </div>

                    <div class="recomendations_block" id="recomendations_block">
                        <div id="recomendations_line"
                            style="display:none; flex-wrap: wrap; gap: 10px; align-items: end; margin-top: 10px;">
                            <div class="input-control inline" style="flex: 1; min-width: 180px;">
                                <div>
                                    <div class="caption max-w300">שם ושם משפחה</div>
                                    <input type="text" name="recomendations_full_name_z[]" class="max-220"
                                        placeholder="">
                                </div>
                            </div>
                            <div class="input-control inline" style="flex: 1; min-width: 150px;">
                                <div>
                                    <div class="caption max-w300">שם משפחה</div>
                                    <input type="text" name="recomendations_last_name_z[]" class="max-220"
                                        placeholder="">
                                </div>
                            </div>
                            <div class="input-control inline" style="flex: 1; min-width: 150px;">
                                <div>
                                    <div class="caption max-w300">תפקיד/ מקצוע</div>
                                    <input type="text" name="recomendations_role_z[]" class="max-220"
                                        placeholder="">
                                </div>
                            </div>
                            <div class="input-control inline" style="flex: 1; min-width: 180px;">
                                <div>
                                    <div class="caption max-w300">כתובת</div>
                                    <input type="text" name="recomendations_address_z[]" class="max-220"
                                        placeholder="">
                                </div>
                            </div>
                            <div class="input-control inline" style="flex: 1; min-width: 120px;">
                                <div>
                                    <div class="caption max-w300">טלפון</div>
                                    <input type="text" name="recomendations_phone_z[]" class="max-220"
                                        placeholder="">
                                </div>
                            </div>
                            <a href="#" class="closebtn" style='visibility:hidden;margin-top:25px'
                                onclick="closeLine(this)"><img src="/img/close-lg.png" /></a>
                        </div>
                    </div>
                </div>

                <div class="aline" style="flex-direction: row-reverse">
                    <div class="input-control leftbtn">
                        <button type="button" class="addbutton"
                            onclick="dublibe('recomendations_block','recomendations_line')">
                            <img src="/img/icons/plus.png" />
                            הוסף ממליץ
                        </button>
                    </div>
                </div>

                <div class="header_line faind_line">
                    הערות נוספות / שונות (כגון ציונים לשבח, פרסי עידוד מיוחדים וכדומה):
                </div>
                <div>
                    <input type="text" name="form5_additional_text" id="form5_additional_text" class="max-660"
                        style="width:710px" placeholder="">
                </div>

                <div>

                    {{-- <div class="aline" style="flex-direction: row-reverse">
                                <button type="button" class="addbutton leftbtn" onclick="showLine()">
                                    <img src="/img/icons/plus.png" />
                                    הוסף שורה
                                </button>
                            </div> --}}
                    <br />
                    <div>
                        <div class="header_line faind_line">
                            צירוף מסמכים
                        </div>
                        <div class="input-control btn-descr file-block" style="transform:translateY(-8px)">
                            <div class="caption bold max-w300">אנא צרף.י קורות חיים <span style="margin-right: 5px;"
                                    data-toggle="tooltip"
                                    title="סוגי מסמכים מותרים הם: jpg, jpeg, doc, docx ו pdf עד 20 mb"><i
                                        class="fas fa-info-circle" aria-hidden="true"></i></span></div>

                            <?php //$key = 2; $file = $form_file[$key];
                            ?>
                            <?php $key = 333; ?>
                            <input type="hidden" name="vals" class="formvalsfile"
                                value="{{ $key }}" />
                            <input type="hidden" name="valsstatic" class="formvalsfilestatic"
                                value="{{ $key }}" />
                            <?php for($z=0; $z<10; $z++,$key++){
                                $file = $form_file[$key];

                                if($z==0){
                                    $style= "";
                                }else{
                                    $style = "style=display:none";

                                }

                                $required_val = $file['required'];
                            ?>
                            <div id="add_file_line_{{ $key }}" class="add_file_line" {{ $style }}>


                                <div class="file-upload-row">
                                    <div class="upload-block">
                                        <a href="#" id="rcfile-upload-{{ $key }}" class="rm"
                                            style="display:none"
                                            onclick="removeFile(this,'{{ $key }}');return false;"><i
                                                class="trash-icon"></i></a>
                                        <input id="{{ $key }}" type="text" disabled
                                            class="btn-input-upload" value="אנא צרף.י תעודה רלוונטית" />
                                        <label for="cfile-upload-{{ $key }}" class="btn-upload ">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="19px"
                                                height="13px" style="transform: scale(0.8)  translateY(4px);">
                                                <path fill-rule="evenodd" fill="rgb(128, 184, 57)"
                                                    d="M14.537,4.008 L-0.000,4.008 L3.496,13.001 L17.666,13.001 L14.537,4.008 ZM19.000,-0.001 L13.480,-0.001 L12.375,2.000 L3.508,2.000 L3.510,2.985 L15.230,2.985 L18.725,13.001 L19.000,13.001 L19.000,-0.001 Z" />
                                            </svg>
                                            <span style="margin-top:-2px">

                                                בחר קובץ
                                            </span>

                                        </label>
                                        {{-- <input id="cfile-upload-{{$key}}" type="file" name="file[{{$key}}]"
										onchange="fileChange(this)"
										accept="application/pdf, image/jpeg, image/jpg, .doc,.docx, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/msword" {{$file['required']}}/> --}}
                                        <input id="cfile-upload-{{ $key }}" type="file"
                                            name="file[{{ $key }}]" onchange="fileChange(this)"
                                            accept="application/pdf" {{ $file['required'] }} />

                                    </div>
                                    <div class="aline">
                                        <button type="button" class="addbutton" onclick="showLineFile(this)"
                                            style="width:30px; height:30px; padding:0;">
                                            <img src="/img/icons/plus.png" />

                                        </button>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="faind_line_small_div">
                        <div class="header_line faind_line">
                            קרובי משפחה
                        </div>
                        <div class="faind_line_small">
                            קרובי משפחה ברשות הינם נבחרים או עובדים. לעניין 'קרוב משפחה' יחשב: בן/בת זוג, הורה, בן, בת,
                            אח, אחות, גיס, גיסה, דוד, דודה, בן-אח, בת-אח, בן-אחות, בת-אחות, חותן, חותנת, חם, חמות, חתן,
                            כלה, נכד, נכדה, לרבות חורג או מאומץ ולרבות בני זוגם, צאצאיהם ובני הזוג של הצאצאים.
                        </div>
                        <div>
                            <div class="faind_line_small">
                                <label class="radio">
                                    <input type="radio" name="nearness" value="yes" required="true"
                                        id="nearness_yes">
                                    <span class="virtual"></span>
                                    <span class="caption">יש לי קרוב משפחה בין עובדי הרשות ונבחריה</span>
                                </label>
                            </div>
                            <div class="faind_line" style="margin-bottom: 0" data-show_type="nearness_yes">
                                <div id="relatives_block">
                                    <div id="relatives_line">
                                        <div class="input-control inline">
                                            <div>
                                                <div class="caption max-w180" style="margin-right:10px">שם פרטי
                                                    ומשפחה של הקרוב</div>
                                                <input type="text" name="relative_name[]" required=""
                                                    class="mmax-220" placeholder="">
                                            </div>
                                        </div>
                                        <div class="input-control inline">
                                            <div>
                                                <div class="caption max-w180">יחס קרבה</div>
                                                <select class="max-220" name="relative_distance[]"
                                                    style="margin-right: 1px">
                                                    <option value="הורה">הורה</option>
                                                    <option value="בן / בת">בן / בת</option>
                                                    <option value=" סב / סבתא">אחות סב / סבתא</option>
                                                    <option value="אח">אחיין / אחיינית</option>
                                                    <option value="דוד">אח / אחות</option>
                                                    <option value="גיס / גיסה (לרבות בני זוגם)">גיס / גיסה (לרבות
                                                        בני
                                                        זוגם)</option>
                                                    <option value="דוד / דודה (לרבות בני זוגם)">דוד / דודה (לרבות
                                                        בני
                                                        זוגם)</option>
                                                    <option value="חותן / חותנת">חותן / חותנת</option>
                                                    <option value="חם / חמות">חם / חמות</option>
                                                    <option value="חתן / כלב">חתן / כלה</option>
                                                    <option value=" נכד / נכדה"> נכד / נכדה</option>
                                                    <option value=" בן/בת זוג"> בן/בת זוג</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="input-control inline">
                                            <div>
                                                <div class="caption max-w180">תיאור התפקיד</div>
                                                <input type="text" name="relative_name_d1[]" required=""
                                                    class="max-660" style="width:710px" placeholder="">
                                            </div>
                                        </div>
                                        <div class="input-control inline">
                                            <div>
                                                <div class="caption max-w180">אגף/מחלקה</div>
                                                <input type="text" name="relative_division_department_d1[]"
                                                    required="" class="max-660" style="width:710px"
                                                    placeholder="">
                                            </div>
                                        </div>
                                        <a href="#" class="closebtn" style='display:none;padding:10px'
                                            onclick="closeLine(this)"><img src="/img/close-lg.png" /></a>

                                    </div>
                                </div>
                                <button type="button" class="addbutton"
                                    onclick="dublibe('relatives_block','relatives_line')">הוסף
                                </button>
                            </div>
                            <div class="faind_line_small">
                                <label class="radio">
                                    <input type="radio" name="nearness" value="no" required="true">
                                    <span class="virtual"></span>
                                    <span class="caption">אין לי קרוב משפחה בין עובדי הרשות ונבחריה</span>
                                </label>
                            </div>
                        </div>

                        <div>
                            <div class="header_line faind_line">
                                <b><u>מניעת ניגוד עניינים</u></b>
                            </div>

                            <div style="display: flex;flex-direction: row; align-items: center;">

                                <div>
                                    <div class="faind_line_small">
                                        <label class="radio">
                                            <input type="radio" name="form5_nigud" value="no">
                                            <span class="virtual"></span>
                                            <span>הריני לאשר כי אין לי ניגוד עניינים ואינני עומד להימצא במצבים
                                                העלולים
                                                לגרום לו להימצא במצב של ניגוד עניינים, ובכלל זה זיקה פוליטית, כלכלית
                                                או
                                                אישית לראש הרשות המקומית, לחבר מועצה ברשות המקומית או לעובד שדרגתו
                                                אחת
                                                משתי הדרגות הגבוהות ביותר ברשות המקומית.</span>
                                        </label>
                                    </div>
                                    <div class="faind_line_small">
                                        <label class="radio">
                                            <input type="radio" name="form5_nigud" id="form5_nigud_yes"
                                                value="yes">
                                            <span class="virtual"></span>
                                            <span> ככל ישנו ניגוד עניינים.</span>
                                        </label>

                                    </div>
                                </div>
                            </div>
                            <div class="faind_line" id='fform5' style="margin-bottom: 0;display:none"
                                data-show_type="form5_nigud_yes">
                                <div class="input-control">
                                    <div>
                                        <div class="caption max-w300">אנא פרט:
                                        </div>
                                        <input type="text" name="form5_nigud_text" id="form5_nigud_text"
                                            required="" class="max-660" style="width:710px" placeholder="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="header_line faind_line">
                                <b><u>ייצוג הולם ושוויון הזדמנויות בעבודה</u></b>
                            </div>
                            <div class="faind_line_small">
                                הרשות מקנה עדיפות לזכאים/ות לכך על פי דין, כדי לקדם את עקרונות הייצוג ההולם ושוויון
                                ההזדמנויות בעבודה
                                וזאת בכפוף לעמידה בתנאי הסף וכשירות לביצוע התפקיד. אם את/ה נמנים עם אחת הקבוצות הבאות
                                סמנ/י במקום המתאים
                            </div>
                            <div style="display: flex;flex-direction: row; align-items: center;">
                                <a href="#" class="rm" onclick="resetRadio();return false;"><i
                                        class="trash-icon"></i></a>
                                <div>
                                    <div class="faind_line_small">
                                        <label class="radio">
                                            <input type="radio" name="form3_ch2" value="disability"
                                                id="form3_ch2_disability">
                                            <span class="virtual"></span>
                                            <span>הנני מועמד/ת עם מוגבלות ונדרשת עבורי התאמה בהליכי הקבלה לעבודה.</span>
                                        </label>
                                    </div>
                                    <div class="faind_line_small">
                                        <label class="radio">
                                            <input type="radio" name="form3_ch2" value="minority"
                                                id="form3_ch2_minority">
                                            <span class="virtual"></span>
                                            <span>הנני מועמד/ת המבקש/ת לקבל עדיפות בשל השתייכותי לאוכלוסיה מזכה.</span>
                                        </label>
                                    </div>
                                    <div class="faind_line_small">
                                        <label class="radio">
                                            <input type="radio" name="form3_ch2" value="none"
                                                id="form3_ch2_none">
                                            <span class="virtual"></span>
                                            <span>אינני נמנה/ית עם אחת מקבוצות אלה.</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!-- Text box for disability option -->
                            <div class="faind_line" id='fform3_disability' style="margin-bottom: 0;display:none"
                                data-show_type="form3_ch2_disability">
                                <div class="input-control">
                                    <div>
                                        <div class="caption max-w300">אנא פרט אילו התאמות נגישות נדרשות לצורך מילוי תפקידך
                                        </div>
                                        <textarea type="text" name="form3_disability_text" class="max-880 height-2lines" placeholder=""></textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Text box for minority option -->
                            <div class="faind_line" id='fform3_minority' style="margin-bottom: 0;display:none"
                                data-show_type="form3_ch2_minority">
                                <div class="input-control">
                                    <div>
                                        <div class="caption max-w300">אנא פרט לאיזה אוכולוסיה מזכה הנך שייך ואם ישנן
                                            התאמות נדרשות לצורך מילוי תפקידך</div>
                                        <textarea type="text" name="form3_minority_text" class="max-880 height-2lines" placeholder=""></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="header_line faind_line">
                                <b><u> הצהרת המועמד</u></b>
                            </div>
                            <div class="faind_line_small">
                                {{-- הריני מצהיר/ה בזאת שכל הפרטים שמסרתי לעיל נכונים וידוע לי כי מסירת פרטים / מסמכים שאינם
                                    נכונים מהווה עבירה על פי חוק --}}
                            </div>
                            <div style="display: flex;flex-direction: row; align-items: center;">
                                {{-- <a href="#" class="rm" onclick="resetRadio();return false;"><i
                                                class="trash-icon"></i></a> --}}
                                <div>
                                    <div class="faind_line_small">
                                        <label class="checkbox">
                                            <input type="checkbox" name="form3_ch2" value="no">
                                            <span class="virtual"></span>
                                            <span>
                                                הריני מצהיר/ה בזאת שכל הפרטים שמסרתי לעיל נכונים וידוע לי כי מסירת פרטים /
                                                מסמכים שאינם נכונים מהווה עבירה על פי חוק

                                                <br> אם יתברר, בזמן כלשהו, כי הצהרתי זו אינה נכונה, אני מתחייב/ת להפסיק את
                                                עבודתי ברשות מיד עם קבלת הודעה מתאימה ממשאבי אנוש ובמקרה זה יראו אותי כמי
                                                שהתפטר/ה מעבודתו/ה ברשות על כל המשתמע מכך. ידוע לי כי במקרה זה לא אהיה
                                                זכאי/ת לפיצויי פיטורים או לדבר אחר כלשהו, וכי אין האמור לעיל גורע מסמכויות
                                                או מזכויות הרשות לנקוט נגדי כל צעד חוקי נוסף בגין מסירת הצהרה בלתי נכונה

                                            </span>
                                        </label>
                                    </div>
                                    <div class="faind_line_small">
                                        <label class="checkbox">
                                            <input type="checkbox" name="form3_ch3" id="form3_ch3" value="yes">
                                            <span class="virtual"></span>
                                            <span>
                                                במידה ולא העלאת בקטגוריית ״תנאי סף״ את כל המסמכים הנדרשים, תשלח אלייך הודעה
                                                במייל להשלמת המסמכים החסרים.
                                                <br> במידה ולא תשלים/י את שליחתם בתוך שבוע מסוים המכרז, הגשתך לא תתקבל

                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div style="font-weight: bold">
                                לאחר שליחת שאלון זה, ישלח לכתובת המייל שהזנת מייל המאשר את קבלת הגשת המועמדות. יש לוודא
                                את תקינות כתובת המייל שהוזנה
                            </div>
                            {{-- <div class="faind_line" id='fform3' style="margin-bottom: 0;display:none"
                                        data-show_type="form3_ch2">
                                        <div class="input-control">
                                            <div>
                                                <div class="caption max-w300">אם כן, אנא פרט אילו התאמות נגישות נדרשות
                                                    לצורך
                                                    מילוי תפקידך
                                                </div>
                                                <textarea type="text" name="form3_text" class="max-880 height-2lines" placeholder=""></textarea>
                                            </div>
                                        </div>
                                    </div> --}}
                        </div>
                        {{-- <div class="header_line faind_line">
                                    <b><u>הצהרת המועמד</u></b>
                                </div>
                                <div class="faind_line_small">
                                    אני מסכים/ה לעמוד בבדיקות הערכה/מיון/מהימנות ו/או מבדקי התאמה נוספים שהעירייה תקבע במידה
                                    ויידרש.<br>
                                    ידוע לי שלא תהיה התייחסות לטופס שלא מולא במלואו ולא הוגשו כל המסמכים הנדרשים.<br>
                                    מודגש כי רק מי שעומד/ת בכל תנאי הסף ומגיש את כלל המסמכים תישקל מועמדותו/ה לתפקיד
                                    שב{{ $textChange }}.<br>
                                </div> --}}
                        {{-- <div class="faind_line_small">
                                    <b><u>מנהלה</u></b><br>
                                    <ul>
                                        <!--<li>במקרה של ריבוי מועמדים תהא העירייה רשאית לבחור מבין המועמדים עד 7 מועמדים מתאימים למשרה, אשר הם בלבד מתוך כל המועמדים יוזמנו להופיע בפני ועדת המכרזים. הבחירה תעשה על יסוד המסמכים בלבד ו/או על יסוד ראיון מוקדם עם המועמדים ו/או חלקם, ע"פ שיקול דעתה הבלעדי של העירייה.</li>-->
                                        <li>הבחירה תעשה על יסוד המסמכים בלבד ו/או על יסוד ראיון מוקדם עם המועמדים ו/או חלקם,
                                            ע"פ
                                            שיקול דעתה הבלעדי של העירייה.</li>
                                        <li>בהתאם לחוק שיווין זכויות לאנשים עם מגבלות תינתן העדפה במשרות הנ"ל למועמדים
                                            העונים על
                                            הגדרת החוק ועונים על דרישות התפקיד.</li>
                                        <li>לפי סעיף 173ב' לפקודת העירייה תינתן עדיפות למועמדים בני העדה האתיופית העונים על
                                            דרישות התפקיד.</li>
                                        <li>במידה ונשלחה דרישה להמצאת מסמכים נוספים הרי שהמועמדות תיבדק רק אם יתקבלו המסמכים
                                            תוך
                                            5 ימים מתאריך הוצאת המכתב ובו בקשה להשלמת מסמכים חסרים, אחרת תראה המועמדות
                                            כמבוטלת.
                                        </li>
                                    </ul>
                                </div> --}}
                        {{-- <div class="faind_line_small" style="font-weight: bold;">
                                    הריני מצהיר בזאת שכל הפרטים שמסרתי לעיל נכונים וידוע לי כי מסירת פרטים / מסמכים שאינם
                                    נכונים
                                    מהווה עבירה על פי חוק.
                                </div>
                                <div class="faind_line_small">
                                    (אם יתברר, בזמן כלשהו, כי הצהרתי זו אינה נכונה, אני מתחייב/ת להפסיק את עבודתי במועצה מיד
                                    עם
                                    קבלת הודעה מתאימה ממנהל משאבי אנוש; ובמקרה זה יראו אותי כמי שהתפטר/ה מעבודתו/ה במועצה על
                                    כל
                                    המשתמע מכך, וידוע לי כי במקרה זה לא אהיה זכאי/ת לפיצויי פיטורים או לדבר אחר כלשהו, וכי
                                    אין
                                    האמור לעיל גורע מסמכויות או מזכויות הרשות לנקוט נגדי כל צעד חוקי נוסף בגין מסירת הצהרה
                                    בלתי
                                    נכונה.)
                                </div> --}}
                    </div>
                    <div class="faind_line mi100" style="display: flex;flex-direction: column">
                        <br>
                        <div class="signature-container" style="text-align: left;float: left; padding-bottom: 50px;">
                            <span class="caption" style="vertical-align: bottom;">חתימה:</span>
                            <div class="signature-content" style="position: relative;">
                                <canvas class="signature" width="200" height="140"
                                    style="height: 140px;touch-action: none;z-index: 1;position: relative;"></canvas>
                                <span class="plesh_sig">
                                    נא תחתום כאן עם העכבר
                                </span>
                                <img class="signature-eraser" src="{{ asset('/front/img/eraser.png') }}" />
                            </div>
                            <div class="img"></div>
                            <input class="signature-text" type="text" name="moth_sign" tabindex="-1" required
                                style="opacity: 0; width: 0.1px; height: 0.1px; margin: 0!important; display: inline-block;">
                        </div>
                        <div class="center  hidden-pdf" style="display:flex;justify-content:center">

                            <button class="btn btn-lg btn-default success bottom-btn-second" id="reportSendBtn"
                                type="submit">
                                שלח
                            </button>
                        </div>
                        <div class="submit-error-msg"></div>
                    </div>
    </form>

    <script language="JavaScript">
        function goback() {
            history.back();
        }

        function checksubmit() {
            var rt0 = Array.from(document.getElementsByTagName("textarea"));
            var rt = Array.from(document.getElementsByTagName("input"));
            rt = rt.concat(rt0);
            // rt={...rt,...rt0};
            console.log('chk sub', rt);

            // var doc=document.getElementsByName("form");
            // console.log(doc);
            for (let i = 0; i < rt.length; i++) {
                // console.log(rt[i]);
                rt[i].required = false;
            }
            var email = document.getElementsByName("email")[0];

            window.email = email ? email.value : '';


        }

        function onsubmit() {
            console.log('submitted!');
            //  window.location.href = '/page2/{{ $tid }}';
        }
    </script>
@endsection
