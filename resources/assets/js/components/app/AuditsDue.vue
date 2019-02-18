<template>

<v-data-table
    :headers="headers"
    :items="items"
    class="elevation-1"
  >
    <template slot="items" slot-scope="props">
      <td class="text-xs-left">{{ props.item.asset_id }}</td>
      <td class="text-xs-left">{{ props.item.assettype.name }}</td>
      <td class="text-xs-left">{{ props.item.next_audit_due }}</td>
      
      
    </template>
  </v-data-table>

</template>

<script>

export default {
    
    data() {
        return {
            items: [],
            headers: [
                {
                    text: 'Asset ID',
                    align: 'left',
                    sortable: true,
                    value: 'asset_id'
                },
                {
                    text: 'Asset type',
                    align: 'left',
                    sortable: true,
                    value: 'name'
                },
                {
                    text: 'Next audit due',
                    align: 'left',
                    sortable: true,
                    value: 'next_audit_due'
                },
                
                
            ]
        }
    },
    methods: {

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
