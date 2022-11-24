<template>
  <div class="calculator">
    <div class="display">{{current || '0'}}</div>
    <!-- <div @click="clear" class="btn">C</div> -->
    <div @click="append('7')" class="btn">7</div>
    <div @click="append('8')" class="btn">8</div>
    <div @click="append('9')" class="btn">9</div>
    <div @click="append('4')" class="btn">4</div>
    <div @click="append('5')" class="btn">5</div>
    <div @click="append('6')" class="btn">6</div>
    <div @click="append('1')" class="btn">1</div>
    <div @click="append('2')" class="btn">2</div>
    <div @click="append('3')" class="btn">3</div>
    <div @click="append('0')" class="btn zero">0</div>
    <div @click="dot" class="btn">.</div>
    <div @click="clear" class="btn operator">C</div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      current: '',
      operatorClicked: false,
    }
  },
  methods: {
    clear() {
      this.current = '';
    },
    append(number) {
      if (this.operatorClicked) {
        this.current = '';
        this.operatorClicked = false;
      }
      this.current = `${this.current}${number}`;
      this.$emit('evento');
    },
    dot() {
      if (this.current.indexOf('.') === -1) {
        this.append('.');
      }
    }


  }
}
</script>

<style scoped>
.calculator {
  margin: 0 auto;
  width: 100%;
  font-size: 30px;
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  grid-auto-rows: minmax(50px, auto);
}
.display {
  grid-column: 1 / 4;
  background-color: #333;
  color: white;
}
.zero {
  grid-column: 1 / 2;
}
.btn {
  background-color: #F2F2F2;
  border: 1px solid #999;
}
.operator {
  background-color: orange;
  color: white;
}
</style>
