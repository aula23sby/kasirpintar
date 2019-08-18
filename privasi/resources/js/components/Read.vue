<template>
	<div class="card">
		<div class="card-header">
			<router-link to="/" class="btn btn-primary float-left"><i class="fa fa-arrow-left"></i> </router-link>
			
		</div>
		<div class="card-body">
			<div v-if="ada==1">
				<h2>{{posts.title}}</h2>
				<hr>
				<p>{{posts.description}}</p>
			</div>
			<div v-else>
				<div class="spinner-grow text-primary" role="status">
				  <span class="sr-only"></span>
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
      errors: [],
      ada: 0,
    }
  },

  // Fetches posts when the component is created.
  created() {
  	let id = this.$route.params.id;
    axios.get('posts/'+id)
    .then(response => {
    	this.ada = 1
      this.posts = response.data
    })
    .catch(e => {
      this.errors.push(e)
    })
  }
}
</script>