<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Updated Post</div>

                    <div class="card-body">
                        <form @submit="submitPostEdit()" enctype="multipart/form-data">
                            <div class="form-group">
                              <label for="usr">Title:</label>
                              <input type="text" class="form-control" id="usr" v-model="posts.title">
                            </div>
                            <div class="form-group">
                              <label for="comment">Description:</label>
                              <textarea class="form-control" rows="5" id="comment" v-model="posts.description"></textarea>
                            </div>
                             <div class="form-group">
                                 <label for="comment">Image:</label>
                                <input type="file" class="form-control" @change="onImageChange">
                            </div>
                            <div class="form-group">
                                <router-link to="/" class="btn btn-danger">Cancel</router-link>
                                <button class="btn btn-primary" :disabled="disabled == 1 ? true : false">
                                <span v-html="btnUpdate"></span>
                                </button>
                            </div>
                        </form>
                        <div v-if="output!=''" class="alert alert-success alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>{{output}}.</strong> Post {{posts.title}} has created
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
  data: function() {
    return {
      posts: {
        title: '',
        description: '',
        image: '',
      },
      output: '',
      errors: [],
      disabled: 0,
      btnUpdate: 'Update',
    }
  },
  created() {
    let id = this.$route.params.id;
    axios.get('posts/'+id+'/edit')
    .then(response => {
      this.posts = response.data
    })
    .catch(e => {
      this.errors.push(e)
    })
  },
  methods: {
    onImageChange(e){
                console.log(e.target.files[0]);
                this.posts.image = e.target.files[0];
     },
      submitPostEdit() {
        let id = this.$route.params.id;
        
        this.disabled = (this.disabled + 1) % 2
        this.btnUpdate='<span class="spinner-border spinner-border-sm"></span>Loading'
        const config = {
            headers: { 'content-type': 'multipart/form-data' }
        }

        let formData = new FormData();
        formData.append('title', this.posts.title);
        formData.append('description', this.posts.description);
        formData.append('image', this.posts.image);
          formData.append('_method', 'PUT');
         console.log(formData)
        axios.post('posts/'+id, formData, config)
        
       // axios.post('posts/'+id, {
        // data: formData,
        // _method: 'put'
        //})
.then(response => {
            //alert(response)
            console.log(response.data)
            this.output = 'Create Success'
          //this.posts = response.data
          this.$router.push({path: '/'})
        })
        .catch(e => {
          this.errors.push(e)
        })
      },
 }
}
</script>
