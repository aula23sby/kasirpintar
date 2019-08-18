<template>
	<div class="card">
		<div class="card-header">
			<router-link to="/create" class="btn btn-primary float-right">Create New Post</router-link>
		</div>
		<div class="card-body">
			<div v-if="posts.length>0">
			<table class="table table-hover table-responsive">
			    <thead>
			      <tr class="d-flex">
			      	<th class="col-1">No.</th>
			      	<th class="col-2">Image</th>
			        <th class="col-3">Title</th>
			        <th class="col-5">Desciption</th>
			        <th class="col-1">Action</th>
			      </tr>
			    </thead>
			    <tbody>
			      <tr v-for="post, index in posts" class="d-flex">
			      	<td class="col-1">{{index+1}}</td>
			      	<td class="col-2"><img :src="viewImage(post.image)" class="rounded img-fluid" alt="Cinque Terre" style="width: : 50%"></td>
			        <td class="col-3">{{post.title}}</td>
			        <td class="col-5">{{post.description}}</td>
			        <td class="col-1"> 
			        	<div class="btn-group-vertical">
			        	<router-link :to="{name: 'readPost', params: {id:post.id}}" class="btn btn-primary">
			        		<i class="fa fa-eye"></i> View</router-link>
			        	<router-link :to="{name: 'editPost', params: {id:post.id}}" class="btn btn-success">
			        		<i class="fa fa-pencil"></i> Update</router-link>
			        	<button class="btn btn-danger" @click="submitPostDelete(post.id,index)"><i class="fa fa-trash"></i> Delete</button>
			        	</div>
			        </td>
			      </tr>
			    </tbody>
			  </table>
			</div>
			<div v-else>
				<div class="text-center">
				<div class="spinner-grow text-primary" role="status" style="width: 3rem; height: 3rem;">
				  <span class="sr-only">Loading...</span>
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
      posts: [],
      imageSrc: '',
      errors: []
    }
  },
  methods: {
      submitPostDelete(id,index) {
      	if(confirm("Click 'Ok' to delete")){
	        axios.delete('posts/'+id, this.posts)
	        .then(response => {
	            console.log(response.data)    
	          this.posts.splice(index,1)
	        })
	        .catch(e => {
	          this.errors.push(e)
	        })
    	}
      },
      viewImage(post){
      	return "Image/"+post;
      }
 },
  // Fetches posts when the component is created.
  created() {
  	
    axios.get('posts')
    .then(response => {
      this.posts = response.data
    })
    .catch(e => {
      this.errors.push(e)
    })
  }
}
</script>