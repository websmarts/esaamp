<template>
<div>
    <v-flex xs8 md4 offset-md8 offset-xs4 style="margin-bottom:2em">
        <v-text-field
            v-model="search"
            append-icon="search"
            label="Search"
            single-line
            hide-details
        ></v-text-field>
    </v-flex>
    

    <v-data-table
        :headers="headers"
        :items="items"
        :search="search"
        class="elevation-1"
    >
        <template slot="items" slot-scope="props">
        <td class="text-xs-left">{{ props.item.asset_id }}</td>
        <td class="text-xs-left">{{ props.item.site }}</td>
        <td class="text-xs-left">{{ props.item.department }}</td>
        <td class="text-xs-left">{{ props.item.type }}</td>
        <td class="text-xs-left">{{ props.item.condition }}</td>
        <td class="text-xs-left">{{ props.item.last_audit_done }}</td>
        <td class="text-xs-left">{{ props.item.next_audit_due }}</td>
        <td class="text-xs-left"><a @click="goto(props.item.asset_id)">audit</a></td>
        
        
        </template>
    </v-data-table>
</div>
</template>

<script>

export default {
    
    data() {
        return {
            search:'',
            items: [],
            headers: [
                {
                    text: 'Asset ID',
                    align: 'left',
                    sortable: true,
                    value: 'asset_id'
                },
                {
                    text: 'Site',
                    align: 'left',
                    sortable: true,
                    value: 'site'
                },
                {
                    text: 'Department',
                    align: 'left',
                    sortable: true,
                    value: 'department'
                },
                {
                    text: 'Asset type',
                    align: 'left',
                    sortable: true,
                    value: 'type'
                },
                {
                    text: 'Condition',
                    align: 'left',
                    sortable: true,
                    value: 'condition'
                },
                {
                    text: 'Last audit',
                    align: 'left',
                    sortable: true,
                    value: 'last_audit_done'
                },
                {
                    text: 'Audit due',
                    align: 'left',
                    sortable: true,
                    value: 'next_audit_due'
                },
                {
                    text: 'Action',
                    align: 'right',
                    sortable: false,
                    value: null
                },
                
                
            ]
        }
    },
    methods: {

        goto(assetId){
            // console.log('GOT0 asset ID',assetId)
             this.$router.push({path:'/view/'+assetId, query:{'tab':'audit'}});
        },

        load() {
            
            this.$api.get('/api/audits',(status,data) => {
                this.items = data.items
            })
        }

    },
    mounted() {
        this.load()
    }

}

</script>
