<template>
    <div id="selectorCategory">
        <div class="form-group my-2">
            <label for="selectorCat">Обрати категорію</label>
            <select
                v-model="selectCategory"
                @change="select"
                ref="sel"
                id="selectorCat"
                class="form-control"

            >
                <option :value="null">Обрати категорію</option>
                <option
                    v-for="item in categoryList"
                    :value="item.id"
                >{{item.title}}</option>
            </select>
            <!-- /#.form-control -->
        </div>
        <!-- /.form-group -->
        <input v-if="show" type="hidden" name="category_id" :value="selectCategory">
    </div>
    <!-- /#selectorCategory -->
</template>

<script>
    export default {
        props: ['defaultCategoryId'],
        data(){
            return {
                selectCategory: '',
                categoryList: [],
                show: false
            }
        },
        methods:{
            loadCategoryList(){
                axios.get('/ajax/category/all')
                .then(resp => {
                    console.log(resp.data.data)
                    this.categoryList = resp.data.data
                    this.show = true
                }).catch(err => {
                    console.error(err)
                })
            },
            select(){
                this.selectCategory = this.$refs.sel.value
            },
        },
        created() {
            console.log(document.querySelectorAll('option'))
        },
        mounted() {
            this.loadCategoryList()
            const defaultId = this.$props.defaultCategoryId
            if (defaultId){
                this.selectCategory = defaultId

                // document.querySelectorAll('option')
                //     .forEach(item => {
                //         if (item.value === defaultId){
                //             item.setAttribute('selected', 'on')
                //         }
                //     })
            }

        }
    }
</script>
