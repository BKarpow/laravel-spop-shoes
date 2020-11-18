<template>
    <div id="navbar">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="/">Каталог товарів</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <template v-for="item in categories">
                        <li class="nav-item" v-if="item.length <= 1">
                            <a class="nav-link" :href="'/catalog/'+item[0].id+'-'+item[0].alias+'.html'">
                                {{item[0].title}}</a>
                        </li>
                        <li v-else class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle"
                               :href="'/catalog/'+item[0].id+'-'+item[0].alias+'.html'"
                               id="navbarDropdownMenuLink"
                               role="button"
                               data-toggle="dropdown"
                               aria-haspopup="true"
                               aria-expanded="false">
                                {{item[0].title}}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a v-for="i in item" class="dropdown-item"
                                   :href="'/catalog/'+i.id+'-'+i['alias']+'.html'">
                                    {{i.title}}
                                </a>

                            </div>
                        </li>
                    </template>
                </ul>
            </div>
        </nav>
    </div>
    <!-- /#navbar -->
</template>

<script>
    export default {
        data(){
            return {
                categories: []
            }
        },
        methods:{
            fetchCategory(){
                axios.get('/ajax/category/sorted').then(r => {

                    this.categories = r.data.data
                }).catch(err => {
                    console.error(err.toString())
                })
            }
        },
        mounted() {
            this.fetchCategory()
        }
    }
</script>
