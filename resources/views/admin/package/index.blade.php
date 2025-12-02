@include('admin.header')
<div class="main-panel">
    <div class="content bg-light">
        <div class="page-inner">
            @if(session('message'))
            <div class="alert alert-success alert-dismissible fade show mb-2" role="alert">
                {{ session('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            <div class="d-flex justify-content-between align-items-center mb-4 mt-3">
                <h1 class="title1 text-dark">Manage Packages</h1>
                <a href="{{ route('admin.packages.create') }}" class="btn btn-primary shadow-sm">
                    <i class="fas fa-plus"></i> Add New Package
                </a>
            </div>

            <!-- Global Search Filter -->
            <div class="card mb-4 border-0 shadow-sm">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-white border-right-0">
                                        <i class="fas fa-search text-muted"></i>
                                    </span>
                                </div>
                                <input type="text" id="packageSearch" class="form-control border-left-0"
                                    placeholder="Search across all packages by tracking number, sender, receiver, or any field...">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" id="clearSearch">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <small class="text-muted mt-1 d-block">Search across ALL packages loaded. Results update
                                instantly.</small>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex align-items-center h-100">
                                <span class="mr-2 text-muted">Showing:</span>
                                <span id="showingCount" class="badge badge-primary badge-pill">{{ count($packages)
                                    }}</span>
                                <span class="mx-2">/</span>
                                <span id="totalCount" class="badge badge-secondary badge-pill">{{ $totalPackages
                                    }}</span>
                                <span class="ml-2 text-muted" id="noResultsMessage" style="display: none;">
                                    No packages found
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="packagesTable">
                            <thead class="thead-light">
                                <tr>
                                    <th>Tracking #</th>
                                    <th>Sender</th>
                                    <th>Receiver</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="packageTableBody">
                                @foreach($packages as $package)
                                <tr class="package-row" data-tracking="{{ strtolower($package->tracking_number) }}"
                                    data-sender="{{ strtolower($package->sender_name) }}"
                                    data-receiver="{{ strtolower($package->receiver_name) }}"
                                    data-sender-phone="{{ strtolower($package->sender_phone ?? '') }}"
                                    data-receiver-phone="{{ strtolower($package->receiver_phone ?? '') }}"
                                    data-sender-address="{{ strtolower($package->sender_address ?? '') }}"
                                    data-receiver-address="{{ strtolower($package->receiver_address ?? '') }}">
                                    <td>
                                        <span class="font-weight-bold text-primary">{{ $package->tracking_number
                                            }}</span>
                                    </td>
                                    <td>{{ $package->sender_name }}</td>
                                    <td>{{ $package->receiver_name }}</td>
                                    <td>
                                        <a href="{{ route('admin.packages.edit', $package->id) }}"
                                            class="btn btn-sm btn-outline-primary" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button class="btn btn-sm btn-outline-danger delete-package"
                                            data-id="{{ $package->id }}" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Client-side Pagination Controls -->
                    <div class="d-flex justify-content-between align-items-center mt-3" id="clientPagination">
                        <div>
                            <span class="text-muted" id="pageInfo">Page 1 of 1</span>
                        </div>
                        <div>
                            <nav aria-label="Page navigation">
                                <ul class="pagination pagination-sm mb-0" id="paginationControls">
                                    <li class="page-item disabled" id="prevPage">
                                        <a class="page-link" href="#" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                    <li class="page-item active"><a class="page-link" href="#" data-page="1">1</a></li>
                                    <li class="page-item disabled" id="nextPage">
                                        <a class="page-link" href="#" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="text-muted mr-2">Show:</span>
                            <select class="form-control form-control-sm w-auto" id="rowsPerPage">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                                <option value="0">All</option>
                            </select>
                        </div>
                    </div>

                    <!-- Message when no results -->
                    <div id="noResults" class="text-center py-5" style="display: none;">
                        <i class="fas fa-package fa-3x text-muted mb-3"></i>
                        <h4 class="text-muted">No packages found</h4>
                        <p class="text-muted">Try adjusting your search terms</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this package? This action cannot be undone.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger btn-sm" id="confirmDelete">Delete</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        let deleteId;
        let searchTimeout;
        let allPackages = [];
        let filteredPackages = [];
        let currentPage = 1;
        let rowsPerPage = 10;
        let totalPages = 1;
        
        // Initialize all packages array
        $('.package-row').each(function() {
            allPackages.push({
                element: $(this),
                tracking: $(this).data('tracking'),
                sender: $(this).data('sender'),
                receiver: $(this).data('receiver'),
                senderPhone: $(this).data('sender-phone'),
                receiverPhone: $(this).data('receiver-phone'),
                senderAddress: $(this).data('sender-address'),
                receiverAddress: $(this).data('receiver-address'),
                html: $(this).html()
            });
        });
        
        filteredPackages = [...allPackages];
        updateDisplay();
        
        // Delete handler
        $(document).on('click', '.delete-package', function() {
            deleteId = $(this).data('id');
            $('#deleteModal').modal('show');
        });

        $('#confirmDelete').click(function() {
            $.ajax({
                url: '/admin/packages/' + deleteId,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.status === 'success') {
                        toastr.success(response.message);
                        $('#deleteModal').modal('hide');
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    }
                },
                error: function() {
                    toastr.error('An error occurred while deleting the package.');
                }
            });
        });

        // Global Search with Instant Filtering
        $('#packageSearch').on('input', function() {
            clearTimeout(searchTimeout);
            
            searchTimeout = setTimeout(() => {
                const searchTerm = $(this).val().trim().toLowerCase();
                currentPage = 1; // Reset to first page on new search
                
                if (searchTerm.length === 0) {
                    filteredPackages = [...allPackages];
                } else {
                    filteredPackages = allPackages.filter(package => {
                        // Search across all data attributes
                        return package.tracking.includes(searchTerm) ||
                               package.sender.includes(searchTerm) ||
                               package.receiver.includes(searchTerm) ||
                               package.senderPhone.includes(searchTerm) ||
                               package.receiverPhone.includes(searchTerm) ||
                               package.senderAddress.includes(searchTerm) ||
                               package.receiverAddress.includes(searchTerm);
                    });
                }
                
                updateDisplay();
                highlightMatches(searchTerm);
            }, 50); // Very fast response time
        });

        // Clear search button
        $('#clearSearch').click(function() {
            $('#packageSearch').val('').focus();
            filteredPackages = [...allPackages];
            currentPage = 1;
            updateDisplay();
        });

        // Allow clearing with Escape key
        $('#packageSearch').keydown(function(e) {
            if (e.key === 'Escape') {
                $(this).val('');
                filteredPackages = [...allPackages];
                currentPage = 1;
                updateDisplay();
            }
        });

        // Rows per page change
        $('#rowsPerPage').change(function() {
            rowsPerPage = parseInt($(this).val());
            currentPage = 1;
            updateDisplay();
        });

        // Pagination click handler
        $(document).on('click', '.page-link', function(e) {
            e.preventDefault();
            const page = $(this).data('page');
            if (page) {
                currentPage = page;
                updateDisplay();
            }
        });

        // Previous page
        $(document).on('click', '#prevPage:not(.disabled)', function(e) {
            e.preventDefault();
            if (currentPage > 1) {
                currentPage--;
                updateDisplay();
            }
        });

        // Next page
        $(document).on('click', '#nextPage:not(.disabled)', function(e) {
            e.preventDefault();
            if (currentPage < totalPages) {
                currentPage++;
                updateDisplay();
            }
        });

        // Update the display
        function updateDisplay() {
            const totalItems = filteredPackages.length;
            
            // Calculate pagination
            if (rowsPerPage > 0) {
                totalPages = Math.ceil(totalItems / rowsPerPage);
                const startIndex = (currentPage - 1) * rowsPerPage;
                const endIndex = Math.min(startIndex + rowsPerPage, totalItems);
                const currentItems = filteredPackages.slice(startIndex, endIndex);
                
                // Update page info
                $('#pageInfo').text(`Page ${currentPage} of ${totalPages} (${totalItems} items)`);
                
                // Update showing count
                $('#showingCount').text(currentItems.length);
            } else {
                // Show all
                totalPages = 1;
                currentPage = 1;
                const currentItems = filteredPackages;
                
                $('#pageInfo').text(`Showing all ${totalItems} items`);
                $('#showingCount').text(totalItems);
            }
            
            // Clear table
            $('#packageTableBody').empty();
            
            // Add filtered items
            if (totalItems === 0) {
                $('#noResults').show();
                $('#packageTableBody').append(`
                    <tr>
                        <td colspan="4" class="text-center py-5 text-muted">
                            <i class="fas fa-package fa-2x mb-2"></i>
                            <p class="mb-0">No packages found</p>
                        </td>
                    </tr>
                `);
                $('#noResultsMessage').show();
            } else {
                $('#noResults').hide();
                $('#noResultsMessage').hide();
                
                const itemsToShow = rowsPerPage > 0 ? 
                    filteredPackages.slice((currentPage - 1) * rowsPerPage, currentPage * rowsPerPage) : 
                    filteredPackages;
                
                itemsToShow.forEach(pkg => {
                    $('#packageTableBody').append(`<tr class="package-row">${pkg.html}</tr>`);
                });
            }
            
            // Update pagination controls
            updatePagination();
            
            // Update total count
            $('#totalCount').text(allPackages.length);
        }
        
        // Update pagination controls
        function updatePagination() {
            if (rowsPerPage === 0 || totalPages <= 1) {
                $('#clientPagination').hide();
                return;
            }
            
            $('#clientPagination').show();
            
            // Previous button
            $('#prevPage').toggleClass('disabled', currentPage === 1);
            
            // Next button
            $('#nextPage').toggleClass('disabled', currentPage === totalPages);
            
            // Page numbers
            let paginationHTML = '';
            
            // Always show first page
            paginationHTML += `<li class="page-item ${currentPage === 1 ? 'active' : ''}">
                <a class="page-link" href="#" data-page="1">1</a>
            </li>`;
            
            // Calculate range of pages to show
            let startPage = Math.max(2, currentPage - 2);
            let endPage = Math.min(totalPages - 1, currentPage + 2);
            
            // Add ellipsis after first page if needed
            if (startPage > 2) {
                paginationHTML += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
            }
            
            // Add middle pages
            for (let i = startPage; i <= endPage; i++) {
                if (i > 1 && i < totalPages) {
                    paginationHTML += `<li class="page-item ${currentPage === i ? 'active' : ''}">
                        <a class="page-link" href="#" data-page="${i}">${i}</a>
                    </li>`;
                }
            }
            
            // Add ellipsis before last page if needed
            if (endPage < totalPages - 1) {
                paginationHTML += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
            }
            
            // Always show last page if there is more than 1 page
            if (totalPages > 1) {
                paginationHTML += `<li class="page-item ${currentPage === totalPages ? 'active' : ''}">
                    <a class="page-link" href="#" data-page="${totalPages}">${totalPages}</a>
                </li>`;
            }
            
            $('#paginationControls').html(`
                <li class="page-item ${currentPage === 1 ? 'disabled' : ''}" id="prevPage">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                ${paginationHTML}
                <li class="page-item ${currentPage === totalPages ? 'disabled' : ''}" id="nextPage">
                    <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            `);
        }

        // Function to highlight matching text
        function highlightMatches(term) {
            if (term.length < 2) return;
            
            const regex = new RegExp(`(${escapeRegExp(term)})`, 'gi');
            
            $('.package-row').each(function() {
                const $row = $(this);
                
                $row.find('td:not(:last-child)').each(function() {
                    const $td = $(this);
                    let text = $td.text();
                    
                    // Remove previous highlights
                    let html = $td.html();
                    html = html.replace(/<mark class="search-highlight">(.*?)<\/mark>/gi, '$1');
                    $td.html(html);
                    
                    // Add new highlights
                    if (regex.test(text)) {
                        const highlighted = text.replace(regex, '<mark class="search-highlight">$1</mark>');
                        $td.html(highlighted);
                    }
                });
            });
        }

        // Helper function to escape regex special characters
        function escapeRegExp(string) {
            return string.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
        }

        // Initial focus on search input
        $('#packageSearch').focus();
    });
</script>

<style>
    .search-highlight {
        background-color: #fff3cd;
        padding: 2px 4px;
        border-radius: 3px;
        font-weight: 600;
        color: #856404;
    }

    #packageSearch:focus {
        border-color: #4dabf7;
        box-shadow: 0 0 0 0.2rem rgba(77, 171, 247, 0.25);
    }

    .package-row:hover {
        background-color: #f8f9fa;
        cursor: pointer;
    }

    #noResults {
        background-color: #f8f9fa;
        border-radius: 8px;
    }

    #clientPagination {
        background-color: #f8f9fa;
        padding: 10px;
        border-radius: 5px;
    }

    .page-item.active .page-link {
        background-color: #4dabf7;
        border-color: #4dabf7;
    }

    .page-link {
        color: #4dabf7;
    }

    .page-link:hover {
        color: #0056b3;
    }
</style>

@include('admin.footer')