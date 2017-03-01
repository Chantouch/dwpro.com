<template xmlns:v-on="http://www.w3.org/1999/xhtml">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-sm-6">
                <div class="pull-left">
                    <h4 class="m-t-0 header-title"><b>Departments</b></h4>
                    <p class="text-muted font-13">
                        Your data of department modules is showing here now.
                    </p>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="pull-right">
                    <button type="button" class="btn btn-success waves-effect waves-light" data-toggle="modal"
                            data-target="#create-department-type">
                        <i class="ti-plus"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="p-20">
            <table class="table table-bordered m-0">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="department in departments">
                    <td scope="row">{{ department.id }}</td>
                    <td>{{ department.name }}</td>
                    <td>{{ department.description }}</td>
                    <td>{{ department.status }}</td>
                    <td>
                        <div class="btn-group">
                            <button class="btn btn-default btn-xs waves-effect waves-light">
                                <i class="glyphicon glyphicon-eye-open"></i></button>
                            <button class="btn btn-default btn-xs waves-effect waves-light"
                                    @click.prevent="editDepartment(department)">
                                <i class="glyphicon glyphicon-edit"></i></button>
                            <button type="submit" class="btn btn-danger btn-xs waves-effect waves-light"
                                    @click.prevent="deleteDepartment(department)">
                                <i class="glyphicon glyphicon-trash"></i></button>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>

            <!-- Pagination -->
            <nav>
                <ul class="pagination">
                    <li v-if="pagination.current_page > 1">
                        <a href="#" aria-label="Previous"
                           @click.prevent="changePage(pagination.current_page - 1)">
                            <span aria-hidden="true">«</span>
                        </a>
                    </li>
                    <li v-for="page in pagesNumber"
                        v-bind:class="[ page == isActive ? 'active' : '']">
                        <a href="#"
                           @click.prevent="changePage(page)">{{ page }}</a>
                    </li>
                    <li v-if="pagination.current_page < pagination.last_page">
                        <a href="#" aria-label="Next"
                           @click.prevent="changePage(pagination.current_page + 1)">
                            <span aria-hidden="true">»</span>
                        </a>
                    </li>
                </ul>
            </nav>

        </div>
        <!-- Create Item Modal -->
        <div class="modal fade" id="create-department-type" tabindex="-1" role="dialog"
             aria-labelledby="myCreateModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                        <h4 class="modal-title" id="myCreateModalLabel">Create Item</h4>
                    </div>
                    <div class="modal-body">
                        <form method="POST" enctype="multipart/form-data" v-on:submit.prevent="createDepartment">
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" name="name" class="form-control" v-model="newDepartment.name"
                                       id="name"/>
                                <span v-if="formErrors['name']"
                                      class="error text-danger">{{ formErrors['name'] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="description">Description:</label>
                                <textarea name="description" class="form-control" id="description"
                                          v-model="newDepartment.description"></textarea>
                                <span v-if="formErrors['description']" class="error text-danger">{{ formErrors['description'] }}</span>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="edit-department-type" tabindex="-1" role="dialog" aria-labelledby="myEditModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                        <h4 class="modal-title" id="myEditModalLabel">Create Item</h4>
                    </div>
                    <div class="modal-body">
                        <form method="POST" enctype="multipart/form-data"
                              v-on:submit.prevent="updateDepartment(fillDepartment.id)">
                            <div class="form-group">
                                <label for="edit-name">Name:</label>
                                <input type="text" name="name" class="form-control" v-model="fillDepartment.name"
                                       id="edit-name"/>
                                <span v-if="formErrorsUpdate['name']"
                                      class="error text-danger">{{ formErrorsUpdate['name'] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="description">Description:</label>
                                <textarea name="edit-description" class="form-control" id="edit-description"
                                          v-model="fillDepartment.description"></textarea>
                                <span v-if="formErrorsUpdate['description']" class="error text-danger">{{ formErrorsUpdate['description'] }}</span>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>
</template>

<script>
    export default {
        data() {
            return {
                edit: false,
                props: {
                    pagination: {
                        type: Object,
                        required: true
                    },
                    offset: {
                        type: Number,
                        default: 4
                    }
                },
                departments: [],
                newDepartment: {
                    'name': '',
                    'description': '',
                    'status': ''
                },
                fillDepartment: {
                    'name': '',
                    'description': '',
                    'status': '',
                    'id': ''
                },
                counter: 0,
                pagination: {},
                offset: 4,
                formErrors: {},
                formErrorsUpdate: {},
                name: ''
            };
        },
        computed: {
            isActive: function () {
                return this.pagination.current_page;
            },
            pagesNumber: function () {
                if (!this.pagination.to) {
                    return [];
                }
                let from = this.pagination.current_page - this.offset;
                if (from < 1) {
                    from = 1;
                }
                let to = from + (this.offset * 2);
                if (to >= this.pagination.last_page) {
                    to = this.pagination.last_page;
                }
                let pagesArray = [];
                for (from = 1; from <= to; from++) {
                    pagesArray.push(from);
                }
                return pagesArray;
            }
        },

        mounted() {
            this.fetchList(this.pagination.current_page);
        },
        methods: {
            fetchList (page_url) {
                this.$http.get('/api/administrator/modules/departments?page=' + page_url).then(function (response) {
                    this.departments = response.data.data;
                    this.pagination = response.data;
                }, function (data) {
                    console.log(data)
                });
            },
            createDepartment(){
                let input = this.newDepartment;
                this.$http.post('/api/administrator/modules/departments', input).then((response) => {
                    this.newDepartment = {
                        'name': '',
                        'description': '',
                        'status': ''
                    };
                    $("#create-department-type").modal('hide');
                    toastr.success('Department created successfully.', 'Success Alert', {timeOut: 5000});
                    this.fetchList();
                    this.changePage(this.pagination.current_page);
                }, (response) => {
                    this.formErrors = response.data;
                });
            },

            editDepartment(department){
                this.fillDepartment.name = department.name;
                this.fillDepartment.description = department.description;
                this.fillDepartment.status = department.status;
                this.fillDepartment.id = department.id;
                $("#edit-department-type").modal('show');
            },
            deleteDepartment(department){
                let accepted = confirm('Do your really want to do this?');
                if (accepted) {
                    this.$http.delete('/api/administrator/modules/departments/' + department.id).then((response) => {
                        toastr.success('Department Deleted Successfully.', 'Success Alert', {timeOut: 5000});
                        this.changePage(this.pagination.current_page);
                    });
                }
            },
            updateDepartment(id){
                let input = this.fillDepartment;
                this.$http.patch('/api/administrator/modules/departments/' + id, input).then((response) => {
                    this.fillDepartment = {
                        'name': '',
                        'description': '',
                        'status': '',
                        'id': ''
                    };
                    $("#edit-department-type").modal('hide');
                    toastr.success('Department Updated Successfully.', 'Success Alert', {timeOut: 5000});
                    this.changePage(this.pagination.current_page);
                }, (response) => {
                    this.formErrorsUpdate = response.data;
                });
            },
            changePage: function (page) {
                this.pagination.current_page = page;
                this.fetchList(page);
            }
        }
    }
</script>
