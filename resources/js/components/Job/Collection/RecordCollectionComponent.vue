<template>
  <div>
    <p>Below details the collection information conducted at <strong>{{ job.costcenter.display_name }} located in 
        {{ job.costcenter.street }} {{ job.costcenter.city }} {{ job.costcenter.state }} {{ job.costcenter.country }}
         </strong> on 
        <strong> {{ job.collection_date }} </strong>.
    </p>
    
    
    <p>Collection Date:  <input required="required" class="form-control col-md-3" type="date" name="collection_date" ></p>
    <p>Collection Details:</p>
    <table class="table table-bordered table-sm" v-if="!isLoading">
        <thead>
            <th width="40%">Waste Item</th>
            <th>Price</th>
            <th>Expected Vol.</th>
            <th>Collected Vol.</th>
            <th width="4%"></th>
        </thead>
        <tbody>
            <tr :key="wasteItem.id" v-for="(wasteItem,index) in job.wastes">
            
                <td> {{ wasteItem.code + ' '}}  {{ wasteItem.name }} </td>
                <td>{{ wasteItem.pivot.unit_price }}</td>
                <td> {{ wasteItem.pivot.volume }} {{ wasteItem.unit.symbol }}</td>
                <td>
                    <input name="volume_collected[]" type="text" v-model="collectedWasteItems[index].pivot.volume_collected" class="form-control-sm">
                    <input type="hidden" name="waste_ids[]" :value="wasteItem.id">
                </td>
                <td v-show="Number(wasteItem.pivot.volume) < Number(collectedWasteItems[index].pivot.volume_collected)">
                    <strong> <span style="font-size:9px;">
                        Attach an image as proof of the actual volume collected:
                        </span></strong>
                        <img width="100" v-if="collectedWasteItems[index].pivot.evidence_img_url != null" :src="collectedWasteItems[index].pivot.evidence_img_url " />
                    <input name="evidence_images[]" :ref="'evidenceimg'+index+''" type="file" @change="onFileChange(index, $event)">
                </td>
            </tr>
        </tbody>
    </table>

  </div>
</template>

    <script>
export default {
    props: ['job'],
  mounted() {
    console.log("Component mounted.");
    this.collectedWasteItems = this.job.wastes
   
   
  },
  data() {
    return {
      collectedWasteItems: [],
      isLoading: false
    };
  },
  methods: {
      onFileChange(index, event) {
        console.log(event.target.files[0])
      const file = event.target.files[0]
      this.collectedWasteItems[index].pivot.evidence_img_url = URL.createObjectURL(file);
    }
  }
};
</script>
