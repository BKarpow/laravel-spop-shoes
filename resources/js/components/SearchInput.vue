<template>
    <div id="search-component" class="ml-4 mt-1">

        <form @submit.prevent="searchGo">
            <div class="form-box">
                <input type="text" @focus="focusField()" v-model="search" placeholder="Пошук взуття...">
                <button type="submit"><i class="fas fa-search"></i></button>

            </div>

        </form>
    </div>
    <!-- /#search-component -->
</template>

<script>
    export default {
        data(){
            return {
                search: '',
                results: []
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        watch:{
            search: function(){
                console.log('Watch ', this.search)
            }
        },
        methods:{
            searchGo(){
                const q = this.search.replace(' ', '+')
                this.fetchSearchResult()
                window.location.href = '/search/?q=' + q
            },
            focusField(){
                console.log('Focus field')
            },

            fetchSearchResult(){
                axios.post('/ajax/search', {q: this.search}).then(r=>{
                    this.results = r.data
                })
            }
        }
    }
</script>

<style scoped lang="scss">
    $height: .4rem;
    $weight: 100%;
    input{
        padding: $height;
        width: $weight;
    }
    .form-box{
        display: flex;
    }
    button{
        position: relative;
        left: -1.5rem;
        height: $height + 1.85rem;
        background: #ffffff ;
        border-left: none;
        border-right: 1px solid black;
        border-bottom: none;
        border-top: 1px solid black;
    }
</style>
