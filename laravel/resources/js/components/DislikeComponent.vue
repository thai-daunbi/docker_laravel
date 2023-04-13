<template>
    <div class="container">
        <div id="success" class="mb-3"></div>
        
       <a style="cursor: pointer" @click.prevent="dislikepost">
           <i class="fa fa-thumbs-o-down" aria-hidden="true"></i> 
           ({{ allDislike }})
       </a>
    </div>
</template>
 
<script>
    export default {
        props:['post'],
        data(){
            return {
                allDislike:'',
            }
        },
        methods:{
            dislikePost(){
                axios.post('/dislike/'+this.post, {post: this.post})
                .then(res =>{
                    this.renderDislike()
                    $('#success').html(res.data.message)
                })
                .catch()
            },
            renderDislike(){
                axios.post('/dislike', {post:this.post})
                .then(res =>{
                    console.log(res.data.post.dislike)
                    this.allDislike = res.data.post.dislike
                })
            }
        },
        mounted() {
            this.renderDislike()
        }
    }
</script>