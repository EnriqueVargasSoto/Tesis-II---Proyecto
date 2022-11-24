<template>
    <div class="calculator">
        <div class="display">{{ current || "0" }}</div>
        <!-- <div @click="clear" class="btn">C</div> -->
        <div class="d-eliminar text-right">
            <i class="fa fa-trash fa-2x mt-1 mr-1" style="color:white;cursor:pointer" @click="eliminar()"></i>
        </div>
        <div @click="append('7')" class="btn d-7">7</div>
        <div @click="append('8')" class="btn d-8">8</div>
        <div @click="append('9')" class="btn d-9">9</div>
        <div @click="append('4')" class="btn d-4">4</div>
        <div @click="append('5')" class="btn d-5">5</div>
        <div @click="append('6')" class="btn d-6">6</div>
        <div @click="append('1')" class="btn d-1">1</div>
        <div @click="append('2')" class="btn d-2">2</div>
        <div @click="append('3')" class="btn d-3">3</div>
        <div @click="append('0')" class="btn d-0">0</div>
        <div class="billete operator">
            <div
                v-bind:class="[
                    billete.estado == true
                        ? 'b_moneda p-2 text-center activo active-d'
                        : 'b_moneda p-2 text-center active-d'
                ]"
                @click="seleccionar(billete, 'billete')"
                v-for="billete in billetes"
                :key="billete.id"
            >
                <i class="fa fa-money" aria-hidden="true"></i>
                {{ billete.billete }}
            </div>
        </div>
        <div class="moneda operator text-center">
            <div
                v-bind:class="[
                    moneda.estado == true
                        ? 'b_moneda p-2 text-center activo active-d'
                        : 'b_moneda p-2 text-center active-d'
                ]"
                @click="seleccionar(moneda, 'moneda')"
                v-for="moneda in monedas"
                :key="moneda.id"
            >
                <i class="fa fa-usd" aria-hidden="true"></i>
                {{ moneda.abreviatura }}
            </div>
        </div>
        <div class="centimo operator">
            <div
                v-bind:class="[
                    centimo.estado == true
                        ? 'b_centimo p-2 text-center activo active-d'
                        : 'b_centimo p-2 text-center active-d'
                ]"
                @click="seleccionar(centimo, 'centimo')"
                v-for="centimo in centimos"
                :key="centimo.id"
            >
                <i class="fa fa-usd" aria-hidden="true"></i>
                {{ centimo.centimo }}
            </div>
        </div>
        <div @click="guardar" class="btn d-enviar operator-enviar">Agregar</div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            current: "",
            operatorClicked: false,
            monedas: [],
            billetes: [],
            centimos: [],
            actual: null
        };
    },
    created: function() {
        this.datos();
    },
    methods: {
        datos() {
            var $this = this;
            axios
                .get(route("Consulta.getMonedas"))
                .then(value => {
                    value.data.forEach((element, index, array) => {
                        $this.monedas.push({
                            id: element.id,
                            moneda: element.moneda,
                            abreviatura: element.abreviatura,
                            estado: false
                        });
                    });
                })
                .catch(value => {});
            axios
                .get(route("Consulta.getBilletes"))
                .then(value => {
                    value.data.forEach((element, index, array) => {
                        $this.billetes.push({
                            id: element.id,
                            billete: element.billete,
                            abreviatura: element.abreviatura,
                            estado: false
                        });
                    });
                })
                .catch(value => {});
            axios
                .get(route("Consulta.getCentimos"))
                .then(value => {
                    value.data.forEach((element, index, array) => {
                        $this.centimos.push({
                            id: element.id,
                            centimo: element.centimo,
                            abreviatura: element.abreviatura,
                            estado: false
                        });
                    });
                })
                .catch(value => {});
        },
        guardar() {
            if (this.actual == null) {
                toastr.error("seleccione un tipo de dinero", "Error");
            } else {
                this.actual.cantidad = this.current;
                this.current = "";
                this.$emit("evento");
            }
        },
        append(number) {
            if (this.operatorClicked) {
                this.current = "";
                this.operatorClicked = false;
            }
            this.current = `${this.current}${number}`;
        },
        seleccionar(item, tipo) {
            this.estadoCentimo();
            this.estadoMoneda();
            this.estadoBillete();

            if (tipo == "billete") {
                this.actual = {
                    id: item.id,
                    abreviatura: item.abreviatura,
                    dinero: item.billete,
                    tipo:"billete"
                };
                this.billetes.forEach((value, index, array) => {
                    if (value == item) {
                        value.estado = true;
                    }
                });
            } else if (tipo == "moneda") {
                this.actual = {
                    id: item.id,
                    abreviatura: item.abreviatura,
                    dinero: item.moneda,
                    tipo:"moneda"
                };
                this.monedas.forEach((value, index, array) => {
                    if (value == item) {
                        value.estado = true;
                    }
                });
            } else if (tipo == "centimo") {
                this.actual = {
                    id: item.id,
                    abreviatura: item.abreviatura,
                    dinero: item.centimo,
                    tipo:"centimo"
                };
                this.centimos.forEach((value, index, array) => {
                    if (value == item) {
                        value.estado = true;
                    }
                });
            }
        },
        estadoBillete() {
            this.billetes.forEach((value, index, array) => {
                value.estado = false;
            });
        },
        estadoMoneda() {
            this.monedas.forEach((value, index, array) => {
                value.estado = false;
            });
        },
        estadoCentimo() {
            this.centimos.forEach((value, index, array) => {
                value.estado = false;
            });
        },
        eliminar(){
            this.current=this.current.substring(0, this.current.length-1)
        }
    }
};
</script>

<style scoped>
.calculator {
    margin: 0 auto;
    width: 100%;
    font-size: 1.0em;
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    grid-auto-rows: minmax(45px, auto);
}
.display {
    grid-column: 2/4;
    grid-row: 2;
    padding-left: 3px;
    background-color: #333;
    color: white;
    font-size:1.9em;
}
.d-eliminar{
    grid-column:4/5;
    background-color: #333;
    grid-row: 2;
}
.d-7 {
    grid-column: 2/3;
    grid-row: 3;
}
.d-8 {
    grid-column: 3/4;
    grid-row: 3;
}
.d-9 {
    grid-column: 4/5;
    grid-row: 3;
}
.d-6 {
    grid-column: 4/5;
    grid-row: 4;
}
.d-5 {
    grid-column: 3/4;
    grid-row: 4;
}
.d-4 {
    grid-column: 2/3;
    grid-row: 4;
}
.d-3 {
    grid-column: 4/5;
    grid-row: 5;
}
.d-2 {
    grid-column: 3/4;
    grid-row: 5;
}
.d-1 {
    grid-column: 2/3;
    grid-row: 5;
}
.d-0 {
    grid-column: 2/4;
    grid-row: 6;
}
.billete {
    grid-column: 1/2;
    grid-row-start: 2;
    grid-row-end: 7;
}
.moneda {
    grid-column: 5/6;
    grid-row-start: 2;
    grid-row-end: 7;
    display: grid;
    grid-template-columns: 1fr;
    grid-template-rows: repeat(3, 1fr);
}
.centimo {
    grid-column: 2/5;
    grid-row: 1;
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    grid-template-rows: 1fr;
}
.d-enviar {
    grid-column: 4/5;
    grid-row: 6;
}

.btn {
    background-color: #f2f2f2;
    border: 1px solid #999;
}
.operator {
    background-color: orange;
    color: white;
}
.b_moneda {
    background-color: #f2f2f2;
    border-radius: 5px;
    font-size: 1.02em;
    margin: 6px 6px 10px 6px;
    padding-top: 20%;
    color: black;
    border: 1px solid #999;
    cursor: pointer;
}
.b_centimo {
    background-color: #f2f2f2;
    border-radius: 5px;
    font-size: 1.02em;
    margin: 6px 6px 10px 6px;
    color: black;
    border: 1px solid #999;
    cursor: pointer;
}
.active-d:hover {
    background-color: rgb(8, 182, 66);
    color: white;
}
.operator-enviar {
    background-color: rgb(8, 182, 66);
    color: white;
}
.activo {
    background-color: rgb(8, 182, 66);
    color: white;
}
</style>
