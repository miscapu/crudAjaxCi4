<?=
$this->extend( 'Layouts/Main' );
$this->section( 'content' );
?>

    <div class="container mt-5">
        <h1 class="mb-4">Name and Email Data</h1>

        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody id="tableBody">
            <?php foreach ($records as $record): ?>
                <tr id="row_<?php echo $record['id']; ?>">
                    <th scope="row"><?php echo $record['id']; ?></th>
                    <td><?php echo $record['name']; ?></td>
                    <td><?php echo $record['email']; ?></td>
                    <td>
                        <button class="btn btn-danger delete-btn" data-id="<?php echo $record['id']; ?>">Delete</button>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap Modal for Delete Confirmation -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this record?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tableBody').on('click', '.delete-btn', function() {
                var id = $(this).data('id');
                $('#deleteModal').modal('show');

                $('#confirmDelete').on('click', function() {
                    $.ajax({
                        url: "<?php echo base_url('/delete/'); ?>" + id,
                        type: 'DELETE',
                        dataType: 'json',
                        success: function(data) {
                            $('#row_' + id).remove();
                            $('#deleteModal').modal('hide');
                        },
                        error: function() {
                            alert('Error deleting data');
                        }
                    });
                });
            });
        });
    </script>

<?php
$this->endSection();