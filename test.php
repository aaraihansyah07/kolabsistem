<div x-data="undanganApp()" class="p-6">

    <!-- Halaman 1 -->
    <div class="space-y-3">
        <template x-if="!hasData">
            <button 
                @click="openPopup()"
                class="px-4 py-2 bg-blue-600 text-white rounded-lg">
                Undang
            </button>
        </template>

        <template x-if="hasData">
            <div class="flex items-center space-x-3">
                <div class="p-3 border rounded-lg bg-gray-50">
                    <p class="font-semibold">Jenis Undangan: <span x-text="data.jenis"></span></p>
                    <p>Keterangan: <span x-text="data.keterangan"></span></p>
                </div>
                <button 
                    @click="openPopup(true)"
                    class="px-4 py-2 bg-yellow-500 text-white rounded-lg">
                    Edit
                </button>
            </div>
        </template>
    </div>

    <!-- Halaman 2 (Popup) -->
    <div 
        x-show="showPopup"
        x-transition
        class="fixed inset-0 bg-black/40 flex items-center justify-center">

        <div class="bg-white p-6 rounded-lg w-96 shadow-lg" @click.outside="closePopup()">

            <h2 class="text-lg font-bold mb-4">Form Undangan</h2>

            <div class="mb-3">
                <label class="block font-medium">Jenis Undangan</label>
                <select x-model="form.jenis" class="w-full border rounded p-2">
                    <option value="">Pilih jenis...</option>
                    <option value="Bisnis">Bisnis</option>
                    <option value="Penelitian">Penelitian</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="block font-medium">Keterangan</label>
                <textarea x-model="form.keterangan" class="w-full border rounded p-2"></textarea>
            </div>

            <div class="flex justify-end space-x-2">
                <button @click="closePopup()" class="px-4 py-2 bg-gray-300 rounded-lg">
                    Batal
                </button>
                <button @click="submit()" class="px-4 py-2 bg-blue-600 text-white rounded-lg">
                    Kirim
                </button>
            </div>

        </div>
    </div>
</div>

<script>
function undanganApp() {
    return {
        showPopup: false,
        data: JSON.parse(localStorage.getItem("undanganData") || "null"),
        
        form: {
            jenis: "",
            keterangan: ""
        },

        get hasData() {
            return this.data !== null;
        },

        openPopup(edit = false) {
            if (edit && this.data) {
                this.form.jenis = this.data.jenis;
                this.form.keterangan = this.data.keterangan;
            } else {
                // reset form saat create baru
                this.form.jenis = "";
                this.form.keterangan = "";
            }

            this.showPopup = true;
        },

        closePopup() {
            this.showPopup = false;
        },

        submit() {
            this.data = {
                jenis: this.form.jenis,
                keterangan: this.form.keterangan
            };

            localStorage.setItem("undanganData", JSON.stringify(this.data));

            this.showPopup = false;
        }
    }
}
</script>
