@extends('include.master')
@section('styles')
    <style>
        .users-container {
            padding: 25px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .users-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .users-table th {
            background: var(--primary-black);
            color: var(--text-light);
            padding: 15px;
            text-align: left;
        }

        .users-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #eee;
        }

        .users-table tr:hover {
            background-color: #fff5f5;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            color: var(--primary-black) !important;
            border: 1px solid #ddd !important;
            margin: 0 2px;
            padding: 5px 10px;
            border-radius: 4px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current,
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: var(--primary-red) !important;
            color: white !important;
            border-color: var(--primary-red) !important;
        }

        .dataTables_wrapper .dataTables_filter input {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 5px 10px;
        }

        .dataTables_wrapper .dataTables_filter input:focus {
            border-color: var(--primary-red);
            outline: none;
        }

        .dataTables_wrapper .dataTables_length select {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 5px 10px;
        }

        .dataTables_wrapper .dataTables_length select:focus {
            border-color: var(--primary-red);
            outline: none;
        }

        .dataTables_wrapper .dataTables_info {
            color: var(--primary-black);
        }

        .dataTables_wrapper .dataTables_processing {
            background: var(--primary-red);
            color: white;
        }

        .date-range-filter {
            display: flex;
            gap: 10px;
            align-items: center;
            margin-bottom: 20px;
        }

        .date-range-filter input {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 5px 10px;
        }

        .date-range-filter input:focus {
            border-color: var(--primary-red);
            outline: none;
        }
    </style>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session('success'))
<script>
document.addEventListener("DOMContentLoaded", function () {
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: "{{ session('success') }}",
        confirmButtonText: 'OK'
    });
});
</script>
@endif

@endsection
@section('content')
    <div class="users-container">
        <h2 class="mb-4">Musiquee Users </h2>
        <div class="table-header">
            <div class="date-range-filter">
                <label for="fromDate">From:</label>
                <input type="date" id="fromDate" class="form-control">
                <label for="toDate">To:</label>
                <input type="date" id="toDate" class="form-control">
            </div>
        </div>
        <table id="usersTable" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Join Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data will be populated by DataTables -->
            </tbody>
        </table>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            const mockData = [{
                    id: 1,
                    name: "John Doe",
                    email: "john@musiquee.com",
                    joinDate: "2023-01-15",
                    status: "Active"
                },
                {
                    id: 2,
                    name: "Jane Smith",
                    email: "jane@musiquee.com",
                    joinDate: "2023-02-20",
                    status: "Inactive"
                },
                {
                    id: 3,
                    name: "Alice Johnson",
                    email: "alice@musiquee.com",
                    joinDate: "2023-03-10",
                    status: "Active"
                },
                {
                    id: 4,
                    name: "Bob Brown",
                    email: "bob@musiquee.com",
                    joinDate: "2023-04-05",
                    status: "Active"
                },
                {
                    id: 5,
                    name: "Charlie Davis",
                    email: "charlie@musiquee.com",
                    joinDate: "2023-05-12",
                    status: "Inactive"
                },
                {
                    id: 6,
                    name: "Eve White",
                    email: "eve@musiquee.com",
                    joinDate: "2023-06-18",
                    status: "Active"
                },
            ];
            const table = $('#usersTable').DataTable({
                data: mockData,
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'joinDate'
                    },
                    {
                        data: 'status'
                    },
                ],
                paging: true,
                pageLength: 5,
                responsive: true,
                dom: '<"top"f>rt<"bottom"lp><"clear">',
            });
            $('#fromDate, #toDate').on('change', function() {
                const fromDate = $('#fromDate').val();
                const toDate = $('#toDate').val();
                table.draw();
            });
            $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
                const fromDate = $('#fromDate').val();
                const toDate = $('#toDate').val();
                const joinDate = data[3]; // Join Date is in the 4th column (index 3)

                if (!fromDate && !toDate) {
                    return true;
                }

                if (!fromDate && joinDate <= toDate) {
                    return true;
                }

                if (!toDate && joinDate >= fromDate) {
                    return true;
                }

                if (joinDate >= fromDate && joinDate <= toDate) {
                    return true;
                }

                return false;
            });
        });
    </script>
@endsection
