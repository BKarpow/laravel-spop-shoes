<template>
    <div id="selectorComponent">
        <div class="form-group" v-if="selectedAttributesList.length">
            <h3>Обрані глобальні атрибути</h3>
            <ul class="list-group">
                <li class="list-group-item" v-for="s_attr in selectedAttributesList" :key="s_attr.id">
                    {{s_attr.title+': '+s_attr.value}}
                </li>
            </ul>
            <input type="hidden" name="attribute_dump" :value="selectedDamp">
        </div>
        <!-- /.form-group -->

        <div class="form-group">
            <label for="g_attr">Оберіть глобальний атрибут</label>
            <select @change="selected" id="g_attr" v-model="selectedAttributeId" class="form-control">
                <option value="0">Обрати категорію</option>
                <option
                    v-for="attr in attributes"
                    :value="attr.id"
                    :key="attr.id"
                >
                    {{attr.title+': '+attr.value}}
                </option>
            </select>
            <!-- /#.form-control -->
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /#selectorComponent -->
</template>

<script>
    export default {
        data(){
            return {
                selectedAttributeId: '0',
                selectedAttributesList: [],
                attributes: [],
                selectedDamp: '',
            }
        },
        methods: {
            selected(){
                let sel_id = 0;
                this.attributes.forEach(item => {
                    if (item.id === this.selectedAttributeId){
                        this.selectedAttributesList.push(item)
                        sel_id = item.id
                    }
                })
                this.attributes = this.attributes.filter(item => {
                    if (item.id === sel_id){
                        return false
                    }
                    return true
                })
                this.selectedAttributeId = '0'
                this.selectedDamp = JSON.stringify(this.selectedAttributesList)
            }
        },
        mounted() {
            // todo поміеять на пост
            axios.get('/ajax/attribute/all').then(resp => {
                this.attributes = resp.data.data
            }).catch(err => {
                console.error(err)
            })
        }
    }
</script>
