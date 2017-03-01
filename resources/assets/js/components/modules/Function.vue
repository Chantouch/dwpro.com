<template xmlns:v-on="http://www.w3.org/1999/xhtml">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-sm-6">
                <div class="pull-left">
                    <h4 class="m-t-0 header-title"><b>Functionss</b></h4>
                    <p class="text-muted font-13">
                        Your data of function modules is showing here now.
                    </p>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="pull-right">
                    <button type="button" class="btn btn-success waves-effect waves-light" data-toggle="modal"
                            data-target="#create-functions">
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
                <tr v-for="fun in functions">
                    <td scope="row">{{ fun.id }}</td>
                    <td>{{ fun.name }}</td>
                    <td>{{ fun.description }}</td>
                    <td>{{ fun.status }}</td>
                    <td>
                        <div class="btn-group">
                            <button class="btn btn-default btn-xs waves-effect waves-light">
                                <i class="glyphicon glyphicon-eye-open"></i></button>
                            <button class="btn btn-default btn-xs waves-effect waves-light"
                                    @click.prevent="editFunctions(fun)">
                                <i class="glyphicon glyphicon-edit"></i></button>
                            <button type="submit" class="btn btn-danger btn-xs waves-effect waves-light"
                                    @click.prevent="deleteFunctions(fun)">
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
        <div class="modal fade" id="create-functions" tabindex="-1" role="dialog"
             aria-labelledby="myCreateModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                        <h4 class="modal-title" id="myCreateModalLabel">Create Item</h4>
                    </div>
                    <div class="modal-body">
                        <form method="POST" enctype="multipart/form-data" v-on:submit.prevent="createFunctions">
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" name="name" class="form-control" v-model="newFunctions.name"
                                       id="name"/>
                                <span v-if="formErrors['name']"
                                      class="error text-danger">{{ formErrors['name'] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="description">Description:</label>
                                <textarea name="description" class="form-control" id="description"
                                          v-model="newFunctions.description"></textarea>
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

        <div class="modal fade" id="edit-functions" tabindex="-1" role="dialog" aria-labelledby="myEditModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                        <h4 class="modal-title" id="myEditModalLabel">Create Item</h4>
                    </div>
                    <div class="modal-body">
                        <form method="POST" enctype="multipart/form-data"
                              v-on:submit.prevent="updateFunctions(fillFunctions.id)">
                            <div class="form-group">
                                <label for="edit-name">Name:</label>
                                <input type="text" name="name" class="form-control" v-model="fillFunctions.name"
                                       id="edit-name"/>
                                <span v-if="formErrorsUpdate['name']"
                                      class="error text-danger">{{ formErrorsUpdate['name'] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="description">Description:</label>
                                <textarea name="edit-description" class="form-control" id="edit-description"
                                          v-model="fillFunctions.description"></textarea>
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
                functions: [],
                newFunctions: {
                    'name': '',
                    'description': '',
                    'status': ''
                },
                fillFunctions: {
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
                this.$http.get('/api/administrator/modules/functions?page=' + page_url).then(function (response) {
                    this.functions = response.data.data;
                    this.pagination = response.data;
                }, function (data) {
                    console.log(data)
                });
            },
            createFunctions(){
                let input = this.newFunctions;
                this.$http.post('/api/administrator/modules/functions', input).then((response) => {
                    this.newFunctions = {
                        'name': '',
                        'description': '',
                        'status': ''
                    };
                    $("#create-functions").modal('hide');
                    toastr.success('Functions created successfully.', 'Success Alert', {timeOut: 5000});
                    this.fetchList();
                    this.changePage(this.pagination.current_page);
                }, (response) => {
                    this.formErrors = response.data;
                });
            },

            editFunctions(fun){
                this.fillFunctions.name = fun.name;
                this.fillFunctions.description = fun.description;
                this.fillFunctions.status = fun.status;
                this.fillFunctions.id = fun.id;
                $("#edit-functions").modal('show');
            },
            deleteFunctions(fun){
                let accepted = confirm('Do your really want to do this?');
                if (accepted) {
                    this.$http.delete('/api/administrator/modules/functions/' + fun.id).then((response) => {
                        toastr.success('Functions Deleted Successfully.', 'Success Alert', {timeOut: 5000});
                        this.changePage(this.pagination.current_page);
                    });
                }
            },
            updateFunctions(id){
                let input = this.fillFunctions;
                this.$http.patch('/api/administrator/modules/functions/' + id, input).then((response) => {
                    this.fillFunctions = {
                        'name': '',
                        'description': '',
                        'status': '',
                        'id': ''
                    };
                    $("#edit-functions").modal('hide');
                    toastr.success('Functions Updated Successfully.', 'Success Alert', {timeOut: 5000});
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
