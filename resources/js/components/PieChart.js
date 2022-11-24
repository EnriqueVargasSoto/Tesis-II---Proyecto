import { Pie, mixins } from "vue-chartjs";
const { reactiveProp } = mixins;

export default {
    extends: Pie,
    mixins: [reactiveProp],
    props: ["charData","options"],
    mounted() {
        this.renderChart(this.chartData, this.options);
    }
};
