<template>
    <div>
        <button class="btn btn-primary" @click="likePost">
            <i class="fa fa-thumbs-up"></i>
            <span class="likes">{{ post.likes }}</span>
        </button>
    </div>
</template>

<script>
export default {
    props: ['post'],
    methods: {
        likePost() {
            this.$emit('like', this.post.id, 'like');
        },
    },
};
</script>
