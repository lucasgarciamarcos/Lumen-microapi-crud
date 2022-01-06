<!DOCTYPE html>
<html>

<head>
    <title>Test CRUD Users</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="{{ url("vendor/bootstrap-5.1.3-dist/css/bootstrap.min.css") }}" />
    <link rel="icon" type="image/png" href="vendor/my-slice.png" />
</head>

<body>
    <div class="container mt-5">
        <form id="searchForm">
            <div class="row g-3 align-items-center">
                <div class="col-auto">
                    <label for="search" class="col-form-label">Search</label>
                </div>
                <div class="col-auto">
                    <input type="text" id="search" name="search" class="form-control" aria-describedby="Search"
                        placeholder="Type email to search">
                </div>
                <div class="col-auto">
                    <button type="button" class="btn btn-primary" onclick="refresh()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-arrow-counterclockwise" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M8 3a5 5 0 1 1-4.546 2.914.5.5 0 0 0-.908-.417A6 6 0 1 0 8 2v1z" />
                            <path
                                d="M8 4.466V.534a.25.25 0 0 0-.41-.192L5.23 2.308a.25.25 0 0 0 0 .384l2.36 1.966A.25.25 0 0 0 8 4.466z" />
                        </svg>
                    </button>
                </div>
            </div>
        </form>
        <div id="table">
            <table class="table table-striped" id="myTable">
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>Edit</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody id="tableContent"></tbody>
            </table>
            <span id="msg"></span>
        </div>
    </div>

    <div class="container mt-5">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Add User
        </button>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="userForm">
                            <div class="row">
                                <div class="form-group col">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        aria-describedby="Email" placeholder="Type user's email" />
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password"
                                        aria-describedby="Password" placeholder="Type user's password" />
                                </div>
                                <div class="mt-1">
                                    <button type="submit" class="btn btn-primary" id="sendButton"
                                        onclick="sendUser(event)">Send</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="sendUser(event)">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <div id="dueDate" class="fs-2"></div>
        <div id="error" class="alert alert-danger" style="display: none" role="alert"></div>
    </div>

    <script type="text/javascript" src="{{ url("vendor/jquery-3.6.0.min.js") }}"></script>
    <script type="text/javascript" src="{{ url("vendor/bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js") }}"></script>

    <script type="text/javascript" src="{{ url("index.js") }}"></script>
</body>

</html>