<template>
    <div>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Token</th>
                <th>Working</th>
                <th>Active</th>
                <th>Delete</th>
                <th>Create</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(token, index) in listTokens" :key="token.id">
                <td>{{token.id}}</td>
                <td>
                    {{token.token}} <span @click="copyToken(token.token)" class="btn btn-success btn-lg"> <i class="fas fa-copy"></i></span>

                </td>
                <td>{{token.working}}</td>
                <td>
                    <a class="toggle" @click="tokenToggle(token.token, index)">
                    <i class="fas " :class="{'fa-toggle-on': token.active, 'fa-toggle-off': !token.active}"> </i>
                    </a>
                </td>
                <td>
                    <button
                        type="button"
                        @click="tokenDelete(token.token, index)"
                        class="btn btn-danger"
                        title="Видалення токену"
                    >
                        <i class="fas fa-trash"></i>
                    </button>
                    <!-- /.btn btn-danger -->
                </td>
                <td>{{token.created_at}}</td>
            </tr>
            </tbody>
        </table>
        <!-- /.table -->
    </div>
</template>

<script>

export default {
    data(){
        return {
            listTokens: []
        }
    },
    methods:{
        tokenToggle(token, index){
            axios.post('/admin/api/token/toggle', {token: token})
            .then(resp => {
                if (resp.data.status){
                    this.listTokens[index].active = !this.listTokens[index].active
                }
            })
        },
        tokenDelete(token, index){
            axios.post('/admin/api/token/delete', {token: token})
                .then(resp => {
                    if(resp.data.status){
                        this.listTokens.splice(index,  1)
                    }
                })
        },
        copyToken(token){
            const cplCont = document.createElement('textarea'); // Створимо елемент
            cplCont.textContent = token; // додамо туди текст
            document.body.append(cplCont); // Додамо елемент до body
            cplCont.select(); // Виділемо весь текст в елементі
            document.execCommand('copy'); // Запустимо команду copy
            cplCont.remove(); // Видалимо обєкт
        }
    },
    mounted() {
        axios.get('/admin/api/token/all').then(resp => {
            console.log(resp.data)
            this.listTokens = resp.data.data
        })
    }
}
</script>

<style scoped>
    .toggle{
        font-size: 2rem;
        cursor: pointer;
    }
</style>
