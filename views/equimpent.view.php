<?php require 'partials/head.php'; ?>

<?php require 'partials/nav.php'; ?>


<?php require 'partials/header.php'; ?>

<script>
    onload = () => {
        fetchEquipment();
    }
</script>

<main>
    <section>
        <p>
            In addition to managing trainers and members, our Gym System also keeps track
            of gym equipment. It records each piece of equipment’s unique ID, name, and
            quantity. This helps the gym to monitor the availability and condition of
            equipment, ensuring a safe and efficient workout environment for its members.
        </p>

        <table>


            <thead>
                <th>Equipment ID</th>
                <th>Name</th>
                <th>Quantity</th>
                <th class="lastHeader">Action <button class="addButton" onclick="toggleAddPopup()">
                        Add +
                    </button></th>
            </thead>

            <tbody id="myTable">

            </tbody>

        </table>



        <div id="popupAddOverlay" class="overlay-container">
            <div class="popup-box">
                <h2>Add Equipment Information</h2>
                <form class="form-container" method="POST" id="addForm" action="/equipment">
                    <input type="hidden" name="_method" value="POST">

                    <label class="form-label" for="addForm-equipmentname">Equipment Name:</label>
                    <input class="form-input" type="text" id="addForm-equipmentname" name="equipmentname" placeholder="EquipmentName" required>
                    <span class="error-message" id="addForm-equipmentname-error" hidden></span><br>

                    <label class="form-label" for="addForm-quantity">Quantity:</label>
                    <input class="form-input" type="text" id="addForm-quantity" name="quantity" placeholder="Quantity" required>
                    <span class="error-message" id="addForm-quantity-error" hidden></span><br>

                    <div class="FormButtons">
                        <button class="submitButton" type="submit" onclick="handleSubmitForm(event, 'addForm', 'equipment')">
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
                <h2>Edit Equipment Information</h2>
                <form class="form-container" method="POST" id="editForm" action="/equipment">
                    <input type="hidden" name="_method" value="PUT">
                    <div id="editFormContent" class="form-container">

                    </div>
                    <div class="FormButtons">

                        <button class="submitButton" type="submit" onclick="handleSubmitForm(event, 'editForm', 'equipment')">
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
                <form class="form-container" method="POST" id="deleteForm" action="/equipment">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" id="deleteId" name="id">
                    <label class="form-label" for="name">Equipment Name:</label>
                    <input class="form-input" type="text" id="deleteName" name="name" placeholder="EquipmentName" disabled><br>
                    <div class="FormButtons">
                        <button class="deleteButton" type="submit" onclick="handleDeleteForm(event, 'equipment')">
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