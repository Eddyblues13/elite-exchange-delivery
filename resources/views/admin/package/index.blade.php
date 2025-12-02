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

            <!-- Enhanced Search Filter -->
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
                                    placeholder="Search by tracking number, sender, receiver, or any related field...">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" id="clearSearch">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <small class="text-muted mt-1 d-block">Start typing to filter results instantly. Search is
                                case-insensitive.</small>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex align-items-center h-100">
                                <span class="mr-2 text-muted">Results:</span>
                                <span id="resultCount" class="badge badge-primary badge-pill">{{ count($packages)
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
                                <tr class="package-row" data-searchable="{{ strtolower(implode(' ', [
                                    $package->tracking_number,
                                    $package->sender_name,
                                    $package->receiver_name,
                                    $package->sender_phone ?? '',
                                    $package->receiver_phone ?? '',
                                    $package->sender_address ?? '',
                                    $package->receiver_address ?? ''
                                ])) }}">
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

                    <!-- Original pagination (hidden when filtering) -->
                    <div id="originalPagination" class="d-flex justify-content-center mt-3">
                        {{ $packages->onEachSide(1)->links('pagination::bootstrap-4') }}
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
        const allPackages = $('.package-row').length;

        // Store original rows
        const originalRows = $('#packageTableBody').html();
        const originalPagination = $('#originalPagination').html();

        // Delete handler
        $('.delete-package').click(function() {
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

        // Enhanced Sensitive Search with Debouncing
        $('#packageSearch').on('input', function() {
            clearTimeout(searchTimeout);
            
            searchTimeout = setTimeout(() => {
                performSearch($(this).val().trim());
            }, 150); // Reduced debounce time for more responsiveness
        });

        // Clear search button
        $('#clearSearch').click(function() {
            $('#packageSearch').val('').focus();
            performSearch('');
        });

        // Allow clearing with Escape key
        $('#packageSearch').keydown(function(e) {
            if (e.key === 'Escape') {
                $(this).val('');
                performSearch('');
            }
        });

        // Perform the actual search
        function performSearch(searchTerm) {
            const term = searchTerm.toLowerCase();
            
            if (term.length === 0) {
                // Show all rows and original pagination
                $('.package-row').show();
                $('#originalPagination').show();
                $('#noResults').hide();
                $('#resultCount').text(allPackages);
                $('#noResultsMessage').hide();
                return;
            }

            // Hide original pagination during search
            $('#originalPagination').hide();

            let visibleCount = 0;
            
            // Search through each row
            $('.package-row').each(function() {
                const searchableText = $(this).data('searchable');
                const isVisible = searchableText.includes(term);
                
                $(this).toggle(isVisible);
                if (isVisible) visibleCount++;
            });

            // Update result count
            $('#resultCount').text(visibleCount);
            
            // Show/hide no results message
            if (visibleCount === 0) {
                $('#noResults').show();
                $('#noResultsMessage').show();
            } else {
                $('#noResults').hide();
                $('#noResultsMessage').hide();
            }

            // Highlight matching text
            highlightMatches(term);
        }

        // Function to highlight matching text
        function highlightMatches(term) {
            if (term.length < 2) return; // Don't highlight for very short terms
            
            $('.package-row:visible').each(function() {
                const $row = $(this);
                
                // Remove previous highlights
                $row.find('td').each(function() {
                    const $td = $(this);
                    let html = $td.html();
                    html = html.replace(/<mark class="search-highlight">(.*?)<\/mark>/gi, '$1');
                    $td.html(html);
                });

                // Add new highlights
                $row.find('td:not(:last-child)').each(function() {
                    const $td = $(this);
                    let text = $td.text();
                    const regex = new RegExp(`(${escapeRegExp(term)})`, 'gi');
                    
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
</style>

@include('admin.footer')