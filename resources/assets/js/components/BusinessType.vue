<template xmlns:v-on="http://www.w3.org/1999/xhtml">
    <div class="col-lg-12">
        <h4 class="m-t-0 header-title"><b>Business Types</b></h4>
        <p class="text-muted font-13">
            Add <code>.table-bordered</code> for borders on all sides of the table and cells.
        </p>
        <div class="pull-right">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#create-business-type">
                Create Item
            </button>
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
                <tr v-for="business in business_types">
                    <th scope="row">{{ business.id }}</th>
                    <td>{{ business.name }}</td>
                    <td>{{ business.description }}</td>
                    <td>{{ business.status }}</td>
                    <td>
                        <button class="btn btn-primary" @click.prevent="editBusinessType(business)">Edit</button>
                        <button class="btn btn-danger" @click.prevent="deleteBusinessType(business)">Delete</button>
                    </td>
                </tr>
                </tbody>
            </table>
            <!-- Pagination -->
            <!--<nav>-->
            <!--<ul class="pagination">-->
            <!--<li v-if="pagination.current_page > 1">-->
            <!--<a href="#" aria-label="Previous"-->
            <!--@click.prevent="changePage(pagination.current_page - 1)">-->
            <!--<span aria-hidden="true">«</span>-->
            <!--</a>-->
            <!--</li>-->
            <!--<li v-for="page in pageNumber"-->
            <!--v-bind:class="[ page == isActive ? 'active' : '']">-->
            <!--<a href="#"-->
            <!--@click.prevent="changePage(page)">@{{ page }}</a>-->
            <!--</li>-->
            <!--<li v-if="pagination.current_page < pagination.last_page">-->
            <!--<a href="#" aria-label="Next"-->
            <!--@click.prevent="changePage(pagination.current_page + 1)">-->
            <!--<span aria-hidden="true">»</span>-->
            <!--</a>-->
            <!--</li>-->
            <!--</ul>-->
            <!--</nav>-->

        </div>
        <!-- Create Item Modal -->
        <div class="modal fade" id="create-business-type" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                        <h4 class="modal-title" id="myModalLabel">Create Item</h4>
                    </div>
                    <div class="modal-body">
                        <form method="POST" enctype="multipart/form-data" v-on:submit.prevent="createBusinessType">
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" name="name" class="form-control" v-model="newBusinessType.name"
                                       id="name"/>
                                <span v-if="formErrors['name']"
                                      class="error text-danger">@{{ formErrors['name'] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="description">Description:</label>
                                <textarea name="description" class="form-control" id="description"
                                          v-model="newBusinessType.description"></textarea>
                                <span v-if="formErrors['description']" class="error text-danger">@{{ formErrors['description'] }}</span>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="edit-business-type" tabindex="-1" role="dialog" aria-labelledby="myEditModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                        <h4 class="modal-title" id="myEditModalLabel">Create Item</h4>
                    </div>
                    <div class="modal-body">
                        <form method="POST" enctype="multipart/form-data" v-on:submit.prevent="updateBusinessType">
                            <div class="form-group">
                                <label for="edit-name">Name:</label>
                                <input type="text" name="name" class="form-control" v-model="fillBusinessType.name"
                                       id="edit-name"/>
                                <span v-if="formErrors['name']"
                                      class="error text-danger">@{{ formErrors['name'] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="description">Description:</label>
                                <textarea name="edit-description" class="form-control" id="edit-description"
                                          v-model="fillBusinessType.description"></textarea>
                                <span v-if="formErrors['description']" class="error text-danger">@{{ formErrors['description'] }}</span>
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
                business_types: [],
                newBusinessType: {
                    'name': '',
                    'description': '',
                    'status': ''
                },
                fillBusinessType: {
                    'name': '',
                    'description': '',
                    'status': '',
                    'id': ''
                },
                pagination: {
                    total: 0,
                    per_page: 2,
                    from: 1,
                    to: 0,
                    current_page: 1
                },
                offset: 4,
                formErrors: {},
                formErrorsUpdate: {},
            };
        },
        computed: {
            isActive(){
                return this.pagination.current_page;
            },
            pageNumber(){
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
                let pageArray = [];
                while (from <= to) {
                    pageArray.push(from);
                    from++;
                }
                return pageArray;
            }
        },

        mounted() {
            this.fetchBusinessList(this.pagination.current_page);
        },
        methods: {
            fetchBusinessList (page) {
                this.$http.get('/api/administrator/modules/business-types?page=' + page).then(function (response) {
                    this.business_types = response.data;
                    this.pagination = response.data.pagination;
                }, function (data) {
                    console.log(data)
                });
            },
            createBusinessType(){
                let input = this.newBusinessType;
                this.$http.post('/api/administrator/modules/business-types', input).then((response) => {
                    this.newBusinessType = {
                        'name': '',
                        'description': '',
                        'status': ''
                    };
                    $("#create-business-type").modal('hide');
                    toastr.success('Business Type created successfully.', 'Success Alert', {timeOut: 5000});
                    this.fetchBusinessList();
                }, (response) => {
                    this.formErrors = response.data;
                });
            },

            editBusinessType(business){
                this.fillBusinessType.name = business.name;
                this.fillBusinessType.description = business.description;
                this.fillBusinessType.status = business.status;
                this.fillBusinessType.id = business.id;
                $("#edit-business-type").modal('show');
            },
            deleteBusinessType(business){
                this.$http.delete('/api/administrator/modules/business-types/' + business.id).then((response) => {
                    this.changePage(this.$pagination.current_page);
                    toastr.success('Business Type Deleted Successfully.', 'Success Alert', {timeOut: 5000});
                })
            },
            updateBusinessType(id){
                let input = this.fillBusinessType;
                this.$http.put('/api/administrator/modules/business-types/' + id, input).then((response) => {
                    this.changePage(this.pagination.current_page);
                    this.fillBusinessType = {
                        'name': '',
                        'description': '',
                        'status': '',
                        'id': ''
                    };
                    $("#edit-business-type").modal('hide');
                    toastr.success('Business Type Updated Successfully.', 'Success Alert', {timeOut: 5000});
                }, (response) => {
                    this.formErrorsUpdate = response.data;
                });
            },

            changePage(page){
                this.pagination.current_page = page;
                this.fetchBusinessList(page);
            }
        }
    }
</script>
