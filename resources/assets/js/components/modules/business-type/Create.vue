<template xmlns:v-on="http://www.w3.org/1999/xhtml">
<div class="col-sm-12">
    <div class="row">
        <form method="POST" enctype="multipart/form-data" v-on:submit.prevent="createBusinessType">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" class="form-control" v-model="newBusinessType.name"
                       id="name"/>
                <span v-if="formErrors['name']"
                      class="error text-danger">{{ formErrors['name'] }}</span>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" class="form-control" id="description"
                          v-model="newBusinessType.description"></textarea>
                <span v-if="formErrors['description']" class="error text-danger">{{ formErrors['description'] }}</span>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </form>
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
            this.fetchBusinessList(this.pagination.current_page);
        },
        methods: {
            fetchBusinessList (page_url) {
                this.$http.get('/api/administrator/modules/business-types?page=' + page_url).then(function (response) {
                    this.business_types = response.data.data;
                    this.pagination = response.data;
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
                    toastr.success('Business Type created successfully.', 'Success Alert', {timeOut: 5000});
                    //this.fetchBusinessList();
                    this.changePage(this.pagination.current_page);
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
                let accepted = confirm('Do your really want to do this?');
                if (accepted) {
                    this.$http.delete('/api/administrator/modules/business-types/' + business.id).then((response) => {
                        toastr.success('Business Type Deleted Successfully.', 'Success Alert', {timeOut: 5000});
                        //this.fetchBusinessList();
                        this.changePage(this.pagination.current_page);
                    });
                }
            },
            updateBusinessType(id){
                let input = this.fillBusinessType;
                this.$http.patch('/api/administrator/modules/business-types/' + id, input).then((response) => {
                    this.fillBusinessType = {
                        'name': '',
                        'description': '',
                        'status': '',
                        'id': ''
                    };
                    $("#edit-business-type").modal('hide');
                    toastr.success('Business Type Updated Successfully.', 'Success Alert', {timeOut: 5000});
                    //this.fetchBusinessList();
                    this.changePage(this.pagination.current_page);
                }, (response) => {
                    this.formErrorsUpdate = response.data;
                });
            },
            changePage: function (page) {
                this.pagination.current_page = page;
                this.fetchBusinessList(page);
            }
        }
    }
</script>