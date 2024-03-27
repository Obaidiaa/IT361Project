<?php require 'partials/head.php'; ?>

<?php require 'partials/nav.php'; ?>


<?php require 'partials/header.php'; ?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">
                            Total Members
                        </dt>
                        <dd class="mt-1 text-3xl font-semibold text-gray-900">
                            <?= count($members); ?>
                        </dd>
                    </dl>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">
                            Active Members
                        </dt>
                        <dd class="mt-1 text-3xl font-semibold text-gray-900">
                            <?= $members[0]['countActive']; ?>
                        </dd>
                    </dl>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">
                            Inactive Members
                        </dt>
                        <dd class="mt-1 text-3xl font-semibold text-gray-900">
                            <?=  $members[0]['countExpired']; ?>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>

        <div class="mt-8">
            <div class="overflow-hidden bg-white shadow sm:rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Members List</h3>
                    <div class="mt-5">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        ID
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Name
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Email
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php foreach ($members as $member) : ?>
                                    <tr>
                                        <td class=" py-4 whitespace-no-wrap">
                                            <div class="flex items-center">
                                                <div class="ml-4">
                                                    <div class="text-sm leading-5 font-medium text-gray-900"><?= $member["MemberID"]; ?></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class=" py-4 whitespace-no-wrap">
                                            <div class="flex items-center">
                                                <div class="ml-4">
                                                    <div class="text-sm leading-5 font-medium text-gray-900"><?= $member["Name"]; ?></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-4 whitespace-no-wrap">
                                            <div class="flex items-center">
                                                <div class="ml-4">
                                                    <div class="text-sm leading-5 font-medium text-gray-900"><?= $member["Email"]; ?></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class=" py-4 whitespace-no-wrap">
                                            <div class="flex items-center">
                                                <div class="ml-4">
                                                    <div class="text-sm leading-5 font-medium text-gray-900"><?= $member["Phone"]; ?></div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



</main>


<?php require 'partials/footer.php'; ?>