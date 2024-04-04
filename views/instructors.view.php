<?php require 'partials/head.php'; ?>

<?php require 'partials/nav.php'; ?>


<?php require 'partials/header.php'; ?>

<script>
    onload = () => {
        fetchInstructors();
    }
</script>

<main>
    <section>
        <p>
            The Gym System efficiently manages all trainer-related information.
            It keeps track of each trainer’s unique ID, name, area of specialization,
            phone number, and email address. This allows for easy access to trainer
            profiles and facilitates communication between trainers and gym management.
        </p>>

        <table>

            <thead>
                <th>Trainer ID</th>
                <th>Name</th>
                <th>Specialization</th>
                <th>Phone</th>
                <th>Email</th>
                <th class="lastHeader">Action <button class="addButton" onclick="toggleAddPopup()">
                        Add +
                    </button></th>
            </thead>

            <tbody id="myTable">

            </tbody>

        </table>

        <div id="popupAddOverlay" class="overlay-container">
            <div class="popup-box">
                <h2>Add Trainer Information</h2>
                <form class="form-container" method="POST" id="addForm" action="/instructors">
                    <input type="hidden" name="_method" value="POST">
                    <label class="form-label" for="addForm-name">Name:</label>
                    <input class="form-input" type="text" id="addForm-name" name="name" placeholder="Name" required><br>
                    <span class="error-message" id="addForm-name-error" hidden></span><br>
                    <label class="form-label" for="specialization">Specialization:</label>
                    <input class="form-input" type="text" id="addForm-specialization" name="specialization" placeholder="Specialization" required><br>
                    <span class="error-message" id="addForm-specialization-error" hidden></span><br>
                    <label class="form-label" for="addForm-phone">Phone:</label>
                    <input class="form-input" type="tel" id="addForm-phone" name="phone" pattern="[0-9]*" title="Phone" placeholder="Phone"><br>
                    <span class="error-message" id="addForm-phone-error" hidden></span><br>
                    <label class="form-label" for="addForm-email">Email:</label>
                    <input class="form-input" type="email" id="addForm-email" name="email" placeholder="Email"><br>
                    <span class="error-message" id="addForm-email-error" hidden></span><br>
                    <div class="FormButtons">
                        <button class="submitButton" type="submit" onclick="handleSubmitForm(event, 'addForm', 'instructor')">
                            Submit
                        </button>

                        <button type="button" class="deleteButton" onclick="toggleAddPopup()">
                            Close
                        </button>
                    </div>
                </form>

            </div>
        </div>


        <div id="popupEditOverlay" class="overlay-container">
            <div class="popup-box">
                <h2>Edit Trainer Information</h2>
                <form class="form-container" id="editForm" method="POST" action="/instructors">
                    <input type="hidden" name="_method" value="PUT">
                    <div id="editFormContent" class="form-container">

                    </div>
                    <div class="FormButtons">

                        <button class="submitButton" type="submit" onclick="handleSubmitForm(event, 'editForm', 'instructor')">
                            Submit
                        </button>

                        <button type="button" class="deleteButton" onclick="toggleEditPopup()">
                            Close
                        </button>
                    </div>
                </form>

            </div>
        </div>


        <div id="popupDeleteOverlay" class="overlay-container">
            <div class="popup-box">
                <h2>Delete Equipment</h2>
                <form class="form-container" id="deleteForm" method="POST" action="/instructors">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" id="deleteId" name="id">
                    <label class="form-label" for="name">Trainer Name:</label>
                    <input class="form-input" type="text" id="deleteName" name="name" placeholder="Trainer Name" disabled><br>
                    <div class="FormButtons">
                        <button class="deleteButton" type="submit" onclick="handleDeleteForm(event, 'instructor')">
                            Delete
                        </button>
                        <button type="button" class="submitButton" onclick="toggleDeletePopup()">
                            Close
                        </button>
                    </div>

                </form>


            </div>
        </div>

    </section>

</main>


<?php require 'partials/footer.php'; ?>