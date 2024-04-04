function toggleAddPopup() {
    const overlay = document.getElementById('popupAddOverlay');
    overlay.classList.toggle('show');
}

function toggleEditPopup(data, formid) {
    console.log(data);
    const overlay = document.getElementById('popupEditOverlay');
    const form = document.getElementById('editFormContent');
    form.innerHTML = '';
    for (const key in data) {
        //check if the property/key is defined in the object itself, not in parent
        if (data.hasOwnProperty(key)) {
            if (key.startsWith('count')) {
                continue;
            }
            //get the value of property
            const value = data[key];

            const keyLowerCase = key.toLowerCase();
            const elementInput = document.createElement('input');
            const elementError = document.createElement('span');
            elementError.id = formid + '-' + keyLowerCase + '-error';
            elementError.className = 'error-message';
            elementError.hidden = true;

            if (key == 'Phone') {
                elementInput.type = 'tel';
                elementInput.pattern = '[0-9]*';
            } else if (key == 'Email') {
                elementInput.type = 'email';
            } else if (key.endsWith('Date')) {
                elementInput.type = 'date';
            }
            else {
                elementInput.type = 'text';
            }

            const elementLabel = document.createElement('label');
            elementLabel.className = 'form-label';
            elementLabel.htmlFor = keyLowerCase;
            elementLabel.innerText = key + ':';

            if (key.endsWith('ID')) {
                elementInput.type = 'hidden';
                elementLabel.style.display = 'none';
            }

            elementInput.className = 'form-input';
            elementInput.id = formid + '-' + keyLowerCase;
            console.log(elementError.id);
            elementInput.name = keyLowerCase;
            elementInput.value = value;
            elementInput.required = true;

            form.appendChild(elementLabel);
            form.appendChild(elementInput);
            form.appendChild(elementError);
            form.appendChild(document.createElement('br'));
        }
    }

    overlay.classList.toggle('show');
}

function toggleDeletePopup(id, name) {
    const overlay = document.getElementById('popupDeleteOverlay');
    console.log(id, name);
    document.getElementById('deleteId').value = id;
    document.getElementById('deleteName').value = name;
    overlay.classList.toggle('show');
}

function handleSubmitForm(event, formid, type) {
    event.preventDefault();
    // Get the form element
    const form = document.getElementById(formid);

    console.log(type, formid);

    // Perform input validation
    if (type == 'member') {
        if (!validateMemberForm(formid)) {
            return;
        }
    } else if (type == 'instructor') {
        if (!validateInstructorForm(formid)) {
            return;
        }
    }
    else if (type == 'equipment') {
        if (!validateEquipmentForm(formid)) {
            return;
        }
    } else {
        return;
    }


    // Get the form data
    const formData = new FormData(form);

    // Convert form data to JSON object
    const jsonData = {};
    for (const [key, value] of formData.entries()) {
        jsonData[key] = value;
    }

    console.log(jsonData);

    fetch(form.action, {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            if (data.status === 'success') {
                // Display a success message
                ToastMessage(data.message, 'green');

                if (formid == 'editForm') {
                    toggleEditPopup();
                }
                else {
                    toggleAddPopup();
                }

                if (type == 'member') {
                    fetchMembers();
                } else if (type == 'instructor') {
                    fetchInstructors();
                } else if (type == 'equipment') {
                    fetchEquipment();
                }


                // Hide the form
                form.reset();
            } else {
                ToastMessage(data.message, 'red');
            }
        })
        .catch(error => {
            ToastMessage('An error occurred. Please try again later.', 'red');
            // Handle any errors that occurred during the request
        });
}

function handleDeleteForm(event, type) {
    event.preventDefault();

    // Get the form element
    const form = document.getElementById('deleteForm');

    // Perform input validation
    if (!form.checkVisibility()) {

        // Get the form inputs
        const inputs = form.querySelectorAll('input');

        // Check if any input is invalid
        for (const input of inputs) {
            if (!input.checkValidity()) {
                // Display an error message
                ToastMessage('Please fill out all required fields.', 'red');
                return;
            }
        }
        return;
    }

    // Get the form data
    const formData = new FormData(form);

    // Convert form data to JSON object
    const jsonData = {};
    for (const [key, value] of formData.entries()) {
        jsonData[key] = value;
    }

    console.log(jsonData);

    fetch(form.action, {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            if (data.status === 'success') {
                // Display a success message
                ToastMessage(data.message, 'green');
                toggleDeletePopup();

                if (type == 'member') {
                    fetchMembers();
                } else if (type == 'instructor') {
                    fetchInstructors();
                } else if (type == 'equipment') {
                    fetchEquipment();
                }

                // Hide the form
                form.reset();
            } else {
                ToastMessage(data.message, 'red');
            }
        })
        .catch(error => {
            ToastMessage('An error occurred. Please try again later.', 'red');
            // Handle any errors that occurred during the request
        });

}

function ToastMessage(text, color) {
    // Get the snackbar DIV
    var x = document.getElementById("snackbar");
    x.innerText = text;
    x.style.backgroundColor = color;
    x.style.color = 'white';
    // Add the "show" class to DIV
    x.className = "show";

    // After 3 seconds, remove the show class from DIV
    setTimeout(function () { x.className = x.className.replace("show", ""); }, 3000);
}


function validateMemberForm(formid) {
    var name = document.getElementById(formid + "-name").value.trim();
    var address = document.getElementById(formid + "-address").value.trim();
    var phone = document.getElementById(formid + "-phone").value.trim();
    var email = document.getElementById(formid + "-email").value.trim();

    var phoneRegex = /^\d{10}$/;
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    clearErrorMessages(formid + "-name");
    clearErrorMessages(formid + "-address");
    clearErrorMessages(formid + "-phone");
    clearErrorMessages(formid + "-email");


    var hasError = false;

    if (name === "") {
        displayErrorMessage(formid + "-name", "Name is required");
        hasError = true;
    }

    if (address === "") {
        displayErrorMessage(formid + "-address", "Address is required");
        hasError = true;
    }

    if (phone === "") {
        displayErrorMessage(formid + "-phone", "Phone number is required");
        hasError = true;
    } else if (!phoneRegex.test(phone)) {
        displayErrorMessage(formid + "-phone", "Invalid phone number format");
        hasError = true;
    }

    if (email === "") {
        displayErrorMessage(formid + "-email", "Email is required");
        hasError = true;
    } else if (!emailRegex.test(email)) {
        displayErrorMessage(formid + "-email", "Invalid email format");
        hasError = true;
    }

    return !hasError;
}


function validateInstructorForm(formid) {
    var name = document.getElementById(formid + "-name").value.trim();
    var specialization = document.getElementById(formid + "-specialization").value.trim();
    var phone = document.getElementById(formid + "-phone").value.trim();
    var email = document.getElementById(formid + "-email").value.trim();

    var phoneRegex = /^\d{10}$/;
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    clearErrorMessages(formid + "-name");
    clearErrorMessages(formid + "-specialization");
    clearErrorMessages(formid + "-phone");
    clearErrorMessages(formid + "-email");

    var hasError = false;

    if (name === "") {
        displayErrorMessage(formid + "-name", "Name is required");
        hasError = true;
    }

    if (specialization === "") {
        displayErrorMessage(formid + "-specialization", "Specialization is required");
        hasError = true;
    }

    if (phone === "") {
        displayErrorMessage(formid + "-phone", "Phone number is required");
        hasError = true;
    } else if (!phoneRegex.test(phone)) {
        displayErrorMessage(formid + "-phone", "Invalid phone number format");
        hasError = true;
    }

    if (email === "") {
        displayErrorMessage(formid + "-email", "Email is required");
        hasError = true;
    } else if (!emailRegex.test(email)) {
        displayErrorMessage(formid + "-email", "Invalid email format");
        hasError = true;
    }

    return !hasError;
}

function validateEquipmentForm(formid) {
    var name = document.getElementById(formid + "-equipmentname").value.trim();
    var quantity = document.getElementById(formid + "-quantity").value.trim();

    console.log(formid + "-equipmentname", formid + "-quantity");

    clearErrorMessages(formid + "-equipmentname");
    clearErrorMessages(formid + "-quantity");

    var hasError = false;

    if (name === "") {
        displayErrorMessage(formid + "-equipmentname", "Equipment name is required");
        hasError = true;
    }

    if (quantity === "") {
        displayErrorMessage(formid + "-quantity", "Quantity is required");
        hasError = true;
    } else if (isNaN(quantity) || parseInt(quantity) <= 0) {
        displayErrorMessage(formid + "-quantity", "Invalid quantity");
        hasError = true;
    }

    return !hasError;
}

// Function to display error message next to the input field
function displayErrorMessage(fieldId, message) {
    var inputField = document.getElementById(fieldId);
    var errorMessageElement = document.getElementById(fieldId + "-error");
    if (!errorMessageElement) {
        errorMessageElement = document.createElement("span");
        errorMessageElement.className = "error-message";
        inputField.parentNode.appendChild(errorMessageElement);
    }
    errorMessageElement.innerText = message;
    errorMessageElement.hidden = false;
    inputField.classList.add("invalid");
}

// Function to remove all error messages
function clearErrorMessages(fieldId) {
    var errorMessageElement = document.getElementById(fieldId + "-error");
    errorMessageElement.hidden = true;
}


function fetchMembers() {
    fetch('/getmembers')
        .then(response => response.json())
        .then(data => {
            const tableBody = document.getElementById('myTable');
            tableBody.innerHTML = '';
            data.data.forEach(member => {
                const row = document.createElement('tr');
                row.innerHTML = `
                <td>${member.MemberID}</td>
                <td>${member.Name}</td>
                <td>${member.Address}</td>
                <td>${member.Phone}</td>
                <td>${member.Email}</td>
                <td>
                    <div class="Action">
                        <button class="deleteButton" onclick='toggleDeletePopup(${member.MemberID}, "${member.Name}")'>
                            Delete
                        </button>
                        <button class="editButton" onclick='toggleEditPopup(${JSON.stringify(member)}, "editForm")'>
                            Edit
                        </button>
                    </div>
                </td>
            `;
                tableBody.appendChild(row);
            });
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

function fetchEquipment() {
    fetch('/getequipment')
        .then(response => response.json())
        .then(data => {
            const tableBody = document.getElementById('myTable');
            tableBody.innerHTML = '';
            data.data.forEach(equipment => {
                const row = document.createElement('tr');
                row.innerHTML = `
                <td>${equipment.EquipmentID}</td>
                <td>${equipment.EquipmentName}</td>
                <td>${equipment.Quantity}</td>
                <td>
                    <div class="Action">
                        <button class="deleteButton" onclick='toggleDeletePopup(${equipment.EquipmentID}, "${equipment.EquipmentName}")'>
                            Delete
                        </button>
                        <button class="editButton" onclick='toggleEditPopup(${JSON.stringify(equipment)}, "editForm")'>
                            Edit
                        </button>
                    </div>
                </td>
            `;
                tableBody.appendChild(row);
            });
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

function fetchInstructors() {
    fetch('/getinstructors')
        .then(response => response.json())
        .then(data => {
            const tableBody = document.getElementById('myTable');
            tableBody.innerHTML = '';
            data.data.forEach(instructor => {
                const row = document.createElement('tr');
                row.innerHTML = `
                <td>${instructor.TrainerID}</td>
                <td>${instructor.Name}</td>
                <td>${instructor.Specialization}</td>
                <td>${instructor.Phone}</td>
                <td>${instructor.Email}</td>
                <td>
                    <div class="Action">
                        <button class="deleteButton" onclick='toggleDeletePopup(${instructor.TrainerID}, "${instructor.Name}")'>
                            Delete
                        </button>
                        <button class="editButton" onclick='toggleEditPopup(${JSON.stringify(instructor)}, "editForm")'>
                            Edit
                        </button>
                    </div>
                </td>
            `;
                tableBody.appendChild(row);
            });
        })
        .catch(error => {
            console.error('Error:', error);
        });
}