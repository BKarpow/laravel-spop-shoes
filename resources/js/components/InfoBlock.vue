<template>
    <div class="infoBlockVue" @click="clickBlock">
        <div class="block-title">
            <h6>{{title}}</h6>
        </div>
        <!-- /.block-title -->
        <div class="block-value">
            <slot></slot>
        </div>
        <!-- /.block-value -->
    </div>
    <!-- /.infoBlockVue -->
</template>

<script>
    export default {
        props: ['title', 'blockAction'],
        methods:{
            clickBlock(){
                this.$emit('click-block', this.$props.blockAction)
            }
        }
    }
</script>

<style scoped lang="scss">
    $bg: #383838;
    $color: #adadad;

    $padding: .5rem 1rem;
    $margin: .5rem;
    $width: 6rem;

    .infoBlockVue{
        padding: $padding;
        margin: $margin;
        background: $bg;
        color: $color;
        .block-title{
            border-bottom: 1px solid $color;
        }
        .block-value{
            text-align: left;
            font-size: 3rem;
        }
    }


</style>
