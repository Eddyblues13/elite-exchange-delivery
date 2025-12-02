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

            <!-- Search Filter -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white border-right-0">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                        </div>
                        <input type="text" id="packageSearch" class="form-control border-left-0"
                            placeholder="Search packages globally... (Type at least 1 character)">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" id="clearSearch"
                                style="display: none;">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <small class="text-muted mt-1 d-block">Searches across all columns instantly</small>
                </div>
                <div class="col-md-3">
                    <div class="form-group mb-0">
                        <select id="searchType" class="form-control">
                            <option value="all">Search All Fields</option>
                            <option value="tracking">Tracking Number</option>
                            <option value="sender">Sender Name</option>
                            <option value="receiver">Receiver Name</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group mb-0">
                        <select id="matchType" class="form-control">
                            <option value="contains">Contains</option>
                            <option value="starts">Starts With</option>
                            <option value="exact">Exact Match</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            Showing <span id="visibleCount">{{ $packages->count() }}</span> of
                            <span id="totalCount">{{ $packages->total() }}</span> packages
                        </div>
                        <div id="searchStatus" class="text-success" style="display: none;">
                            <i class="fas fa-filter"></i> Search active
                        </div>
                    </div>

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
                            <tbody id="packagesTableBody">
                                @foreach($packages as $package)
                                <tr class="package-row" data-full-data="{{ json_encode([
                                    'tracking' => strtolower($package->tracking_number),
                                    'sender' => strtolower($package->sender_name),
                                    'receiver' => strtolower($package->receiver_name)
                                ]) }}">
                                    <td class="tracking-col">{{ $package->tracking_number }}</td>
                                    <td class="sender-col">{{ $package->sender_name }}</td>
                                    <td class="receiver-col">{{ $package->receiver_name }}</td>
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

                    <!-- No Results Message -->
                    <div id="noResults" class="text-center py-5" style="display: none;">
                        <i class="fas fa-search fa-3x text-muted mb-3"></i>
                        <h4 class="text-muted">No packages found</h4>
                        <p class="text-muted">Try different search terms</p>
                    </div>

                    <!-- Pagination (initially hidden when searching) -->
                    <div id="paginationContainer" class="d-flex justify-content-center mt-3">
                        {{ $packages->onEachSide(1)->links('pagination::bootstrap-4') }}
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
        let allPackages = [];
        let isSearching = false;

        // Store all package data from current page
        $('.package-row').each(function() {
            allPackages.push({
                element: $(this),
                data: $(this).data('full-data'),
                html: $(this).html()
            });
        });

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

        // Clear search button
        $('#clearSearch').click(function() {
            $('#packageSearch').val('');
            performSearch('');
            $(this).hide();
        });

        // Enhanced Search Function
        function performSearch(searchTerm) {
            searchTerm = searchTerm.trim().toLowerCase();
            const searchType = $('#searchType').val();
            const matchType = $('#matchType').val();
            
            if (searchTerm.length === 0) {
                // Show all rows
                $('.package-row').show();
                $('#noResults').hide();
                $('#searchStatus').hide();
                $('#visibleCount').text($('.package-row').length);
                $('#paginationContainer').show();
                isSearching = false;
                return;
            }

            let visibleCount = 0;
            isSearching = true;
            
            // Hide pagination during search
            $('#paginationContainer').hide();
            $('#searchStatus').show();

            // Search through all stored package rows
            allPackages.forEach(function(package) {
                let matches = false;
                
                switch(searchType) {
                    case 'tracking':
                        matches = searchInField(package.data.tracking, searchTerm, matchType);
                        break;
                    case 'sender':
                        matches = searchInField(package.data.sender, searchTerm, matchType);
                        break;
                    case 'receiver':
                        matches = searchInField(package.data.receiver, searchTerm, matchType);
                        break;
                    case 'all':
                        matches = searchInField(package.data.tracking, searchTerm, matchType) ||
                                 searchInField(package.data.sender, searchTerm, matchType) ||
                                 searchInField(package.data.receiver, searchTerm, matchType);
                        break;
                }

                if (matches) {
                    package.element.show();
                    visibleCount++;
                    // Highlight matching text
                    highlightText(package.element, searchTerm, searchType);
                } else {
                    package.element.hide();
                }
            });

            // Update counts
            $('#visibleCount').text(visibleCount);
            
            // Show/hide no results message
            if (visibleCount === 0) {
                $('#noResults').show();
            } else {
                $('#noResults').hide();
            }
        }

        // Helper function for search matching
        function searchInField(fieldValue, searchTerm, matchType) {
            if (!fieldValue) return false;
            
            switch(matchType) {
                case 'contains':
                    return fieldValue.includes(searchTerm);
                case 'starts':
                    return fieldValue.startsWith(searchTerm);
                case 'exact':
                    return fieldValue === searchTerm;
                default:
                    return fieldValue.includes(searchTerm);
            }
        }

        // Highlight matching text
        function highlightText(row, searchTerm, searchType) {
            // Remove previous highlights
            row.find('.highlight').each(function() {
                $(this).replaceWith($(this).text());
            });

            if (searchType === 'all' || searchType === 'tracking') {
                highlightColumn(row.find('.tracking-col'), searchTerm);
            }
            if (searchType === 'all' || searchType === 'sender') {
                highlightColumn(row.find('.sender-col'), searchTerm);
            }
            if (searchType === 'all' || searchType === 'receiver') {
                highlightColumn(row.find('.receiver-col'), searchTerm);
            }
        }

        function highlightColumn(column, searchTerm) {
            const text = column.text();
            const regex = new RegExp(`(${searchTerm.replace(/[.*+?^${}()|[\]\\]/g, '\\$&')})`, 'gi');
            const newText = text.replace(regex, '<span class="highlight bg-warning">$1</span>');
            column.html(newText);
        }

        // Real-time search with debouncing
        let searchTimeout;
        $('#packageSearch').on('input', function() {
            const searchTerm = $(this).val();
            
            // Show/hide clear button
            if (searchTerm.length > 0) {
                $('#clearSearch').show();
            } else {
                $('#clearSearch').hide();
            }

            // Clear previous timeout
            clearTimeout(searchTimeout);
            
            // Set new timeout for debouncing (50ms for instant feel)
            searchTimeout = setTimeout(() => {
                performSearch(searchTerm);
            }, 50);
        });

        // Search type change triggers search
        $('#searchType, #matchType').change(function() {
            const searchTerm = $('#packageSearch').val();
            if (searchTerm.length > 0) {
                performSearch(searchTerm);
            }
        });

        // Load all data via AJAX for true global search (optional)
        function loadAllPackages() {
            $.ajax({
                url: '{{ route("admin.packages.index") }}?all=1',
                type: 'GET',
                success: function(response) {
                    // Parse response and add to allPackages array
                    // This would require server-side endpoint to return all packages
                }
            });
        }

        // Initialize
        if ($('#packageSearch').val().length > 0) {
            performSearch($('#packageSearch').val());
        }
    });
</script>

<style>
    .highlight {
        padding: 1px 3px;
        border-radius: 3px;
        font-weight: bold;
    }

    #searchStatus {
        font-size: 0.9rem;
    }

    .input-group-text {
        border-right: 0;
    }

    .form-control.border-left-0 {
        border-left: 0;
    }
</style>

@include('admin.footer')