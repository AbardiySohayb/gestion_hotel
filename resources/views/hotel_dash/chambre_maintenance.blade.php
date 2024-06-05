<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Hotel dash</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet"> 
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href={{asset('lib/owlcarousel/assets/owl.carousel.min.css')}} rel="stylesheet">
    <link href={{asset('lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css')}} rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css/bootstraps.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark">
                <a href="index.html" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>Hotel</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="{{asset('img/user.jpg')}}" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <span>Admin</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="{{ route('hotel_dash.index') }}" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                   
                    <a href="{{ route('hotel_dash.chambre_maintenance') }}" class="nav-item nav-link active"><i class="fa fa-th me-2"></i>maintenance</a>
                    
                    </div>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <form class="d-none d-md-flex ms-4">
                    <input class="form-control bg-dark border-0" type="search" placeholder="Search">
                </form>
                <div class="navbar-nav align-items-center ms-auto">
                    
                    
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="{{asset('img/user.jpg')}}" alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex">Admin</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="{{ route('logout') }}" class="dropdown-item">Log Out</a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->

            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h4 class="mb-4">Chambres en Maintenance</h4>
                            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addModal">Ajouter une Chambre</button>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Numéro de Chambre</th>
                                            <th>Date Début</th>
                                            <th>Date Fin</th>
                                            <th>Description</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="maintenanceTableBody">
                                        @foreach($chambres as $chambre)
                                        <tr id="chambre-{{ $chambre->id }}">
                                            <td>{{ $chambre->chambre->numero }}</td>
                                            <td>{{ $chambre->date_debut }}</td>
                                            <td>{{ $chambre->date_fin }}</td>
                                            <td>{{ $chambre->description }}</td>
                                            <td>
                                                <button class="btn btn-warning btn-sm" onclick="openEditModal({{ $chambre->id }})">Modifier</button>
                                                <button class="btn btn-danger btn-sm" onclick="openDeleteModal({{ $chambre->id }})">Supprimer</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

           <!-- Modal pour Ajouter une Chambre -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Ajouter une Chambre en Maintenance</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addForm">
                    @csrf
                    <div class="mb-3">
                        <label for="addChambreId" class="form-label">ID de Chambre</label>
                        <input type="text" id="addChambreId" name="chambre_id" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="addStartDate" class="form-label">Date Début</label>
                        <input type="date" id="addStartDate" name="date_debut" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="addEndDate" class="form-label">Date Fin</label>
                        <input type="date" id="addEndDate" name="date_fin" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="addDescription" class="form-label">Description</label>
                        <textarea id="addDescription" name="description" class="form-control"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal pour Modifier une Chambre -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Modifier une Chambre en Maintenance</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editChambreId" name="id">
                    <div class="mb-3">
                        <label for="editChambreIdField" class="form-label">ID de Chambre</label>
                        <input type="text" id="editChambreIdField" name="chambre_id" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="editStartDate" class="form-label">Date Début</label>
                        <input type="date" id="editStartDate" name="date_debut" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="editEndDate" class="form-label">Date Fin</label>
                        <input type="date" id="editEndDate" name="date_fin" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="editDescription" class="form-label">Description</label>
                        <textarea id="editDescription" name="description" class="form-control"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Modifier</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal pour Confirmer la Suppression -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Supprimer une Chambre en Maintenance</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Êtes-vous sûr de vouloir supprimer cette chambre en maintenance?</p>
                <button type="button" class="btn btn-danger" id="confirmDelete">Supprimer</button>
            </div>
        </div>
    </div>
</div>


            <!-- Footer Start -->
           
            <!-- Footer End -->
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src={{asset('lib/chart/chart.min.js')}}></script>
    <script src={{asset('lib/easing/easing.min.js')}}></script>
    <script src={{asset('lib/waypoints/waypoints.min.js')}}></script>
    <script src={{asset('lib/owlcarousel/owl.carousel.min.js')}}></script>
    <script src={{asset('lib/tempusdominus/js/moment.min.js')}}></script>
    <script src={{asset('lib/tempusdominus/js/moment-timezone.min.js')}}></script>
    <script src={{asset('lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js')}}></script>

    <!-- Template Javascript -->
    <!-- Template Javascript -->
<script src="{{ asset('js/maind.js') }}"></script>

<script>
    $(document).ready(function () {

    // Ajout de chambre
    $('#addForm').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: '{{ route("hotel_dash.storeChambre") }}',
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                $('#addModal').modal('hide');
                $('#maintenanceTableBody').append(`
                    <tr id="chambre-${response.id}">
                        <td>${response.chambre.numero}</td>
                        <td>${response.date_debut}</td>
                        <td>${response.date_fin}</td>
                        <td>${response.description}</td>
                        <td>
                            <button class="btn btn-warning btn-sm" onclick="openEditModal(${response.id})">Modifier</button>
                            <button class="btn btn-danger btn-sm" onclick="openDeleteModal(${response.id})">Supprimer</button>
                        </td>
                    </tr>
                `);
            },
            error: function(xhr) {
                console.error(xhr.responseText);
            }
        });
    });

   // Ouverture du modal de modification
   window.openEditModal = function(id) {
    console.log('openEditModal called with id:', id);
    $.get(`{{ url('/hotel_dash/chambre') }}/${id}`, function(response) {
        console.log('AJAX response:', response);
        $('#editChambreId').val(response.id);
        $('#editChambreIdField').val(response.chambre_id);
        $('#editStartDate').val(response.date_debut);
        $('#editEndDate').val(response.date_fin);
        $('#editDescription').val(response.description);
        $('#editModal').modal('show');
    }).fail(function(xhr) {
        console.error('AJAX error:', xhr.responseText);
    });
};





    // Modification de chambre
    $('#editForm').submit(function(e) {
    e.preventDefault();
    let id = $('#editChambreId').val();
    $.ajax({
        url: `{{ url('/hotel_dash/chambre') }}/${id}`,
        method: 'PUT',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: $(this).serialize(),
        success: function(response) {
            $('#editModal').modal('hide');
            $(`#chambre-${id}`).html(`
                <td>${response.chambre.numero}</td>
                <td>${response.date_debut}</td>
                <td>${response.date_fin}</td>
                <td>${response.description}</td>
                <td>
                    <button class="btn btn-warning btn-sm" onclick="openEditModal(${response.id})">Modifier</button>
                    <button class="btn btn-danger btn-sm" onclick="openDeleteModal(${response.id})">Supprimer</button>
                </td>
            `);
        },
        error: function(xhr) {
            console.error(xhr.responseText);
        }
    });
});


    // Suppression de chambre
    window.openDeleteModal = function(id) {
        $('#confirmDelete').off('click').on('click', function() {
            $.ajax({
                url: `{{ url('/hotel_dash/chambre') }}/${id}`,
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('#deleteModal').modal('hide');
                    $(`#chambre-${response.id}`).remove();
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            });
        });
        $('#deleteModal').modal('show');
    };
});



</script>

</body>

</html>