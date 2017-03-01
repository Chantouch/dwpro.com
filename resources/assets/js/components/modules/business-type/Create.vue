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
    export default{

    }
</script>