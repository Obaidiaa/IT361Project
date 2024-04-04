<?php require 'partials/head.php'; ?>

<?php require 'partials/nav.php'; ?>


<?php require 'partials/header.php'; ?>


<main>
    <section>
        <p>
            Our Gym System also excels in managing member information.
            It maintains a record of each member’s unique ID, name, address, phone number,
            and email address. This comprehensive database of member information enables
            the gym to provide personalized services and maintain strong communication
            with its members.
        </p>

        <table>
            <thead>
                <tr>
                    <th>Member ID</th>
                    <th>Name</th>
                    <th>address</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th class="lastHeader">Action <button class="addButton" onclick="toggleAddPopup()">
                            Add +
                        </button></th>
                </tr>
            </thead>

            <tbody id="myTable">
                <?php foreach ($members as $member) : ?>
                    <tr>
                        <td><?= $member["MemberID"]; ?></td>
                        <td><?= $member["Name"]; ?></td>
                        <td><?= $member["Address"]; ?></td>
                        <td><?= $member["Phone"]; ?></td>
                        <td><?= $member["Email"]; ?></td>
                        <td>

                            <div class="Action">
                                <button class="deleteButton" onclick='toggleDeletePopup(<?= $member["MemberID"]; ?>, "<?= $member["Name"]; ?>")'>
                                    Delete
                                </button>
                                <button class="editButton" onclick='toggleEditPopup(<?= json_encode($member); ?>, "editForm")'>
                                    Edit
                                </button>
                                </button>
                            </div>

                            <!-- <form method="POST" action="/members">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="id" value="<?= $member["MemberID"]; ?>">
                                <button type="submit">
                                    Delete
                                </button>
                            </form> -->

                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>

        </table>

        <div id="popupAddOverlay" class="overlay-container">
            <div class="popup-box">
                <h2>Add Member Information</h2>
                <form class="form-container" id="addForm" method="POST" action="/members">

                    <label class="form-label" for="addForm-name">Name:</label>
                    <input class="form-input" type="text" id="addForm-name" name="name" placeholder="Name" required><br>
                    <span class="error-message" id="addForm-name-error" hidden></span><br>
                    <label class="form-label" for="addForm-address">Address:</label>
                    <input class="form-input" type="text" id="addForm-address" name="address" placeholder="address" required><br>
                    <span class="error-message" id="addForm-address-error" hidden></span><br>
                    <label class="form-label" for="addForm-phone">Phone:</label>
                    <input class="form-input" type="tel" id="addForm-phone" name="phone" pattern="[0-9]*" title="Phone" placeholder="Phone"><br>
                    <span class="error-message" id="addForm-phone-error" hidden></span><br>
                    <label class="form-label" for="addForm-email">Email:</label>
                    <input class="form-input" type="email" id="addForm-email" name="email" placeholder="Email"><br>
                    <span class="error-message" id="addForm-email-error" hidden></span><br>
                    <div class="FormButtons">
                        <button class="submitButton" type="submit" onclick="handleSubmitForm(event, 'addForm', 'member')">
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
                <h2>Edit Member Information</h2>
                <form class="form-container" id="editForm" method="POST" action="/members">
                    <input type="hidden" name="_method" value="PUT">
                    <div id="editFormContent" class="form-container">

                    </div>
                    <div class="FormButtons">

                        <button class="submitButton" type="submit" onclick="handleSubmitForm(event, 'editForm', 'member')">
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
                <h2>Delete Member</h2>
                <form class="form-container" id="deleteForm" method="POST" action="/members">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" id="deleteId" name="id">
                    <label class="form-label" for="name">Member Name:</label>
                    <input class="form-input" type="text" id="deleteName" name="name" placeholder="Member Name" disabled><br>
                    <div class="FormButtons">
                        <button class="deleteButton" type="submit" onclick="handleDeleteForm(event)">
                            Delete
                        </button>
                        <button type="button" class="submitButton" onclick="toggleDeletePopup()">
                            Close
                        </button>
                    </div>

                </form>


            </div>

    </section>


</main>


<?php require 'partials/footer.php'; ?>