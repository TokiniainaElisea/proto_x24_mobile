<template>
    <button type="button" class="btn btn-primary" @click="generatePdf">
        Télécharger PDF
    </button>
    <div class="invoice-wrapper" ref="invoiceRef">

        <!-- EN-TÊTE -->
        <table class="header-table">
            <tr>
                <td style="width: 58%;">
                    <div class="company-name">
                        {{ company.name }}
                    </div>

                    <div v-if="company.legal_name" class="muted">
                        {{ company.legal_name }}
                    </div>

                    <div v-if="company.address" class="muted" style="margin-top: 6px;">
                        {{ company.address }}
                    </div>

                    <div v-if="company.phone" class="muted">
                        Tél. : {{ company.phone }}
                    </div>

                    <div class="small" style="margin-top: 10px;">
                        <div v-if="company.nif">
                            <strong>NIF :</strong> {{ company.nif }}
                        </div>

                        <div v-if="company.stat">
                            <strong>STAT :</strong> {{ company.stat }}
                        </div>

                        <div v-if="company.rcs">
                            <strong>RCS :</strong> {{ company.rcs }}
                        </div>
                    </div>
                </td>

                <td style="width: 42%;">
                    <div class="invoice-title">
                        Facture
                    </div>

                    <div class="invoice-meta">
                        <div>
                            <strong>N° :</strong>
                            {{ sale.sale_reference }}
                        </div>

                        <div>
                            <strong>Date :</strong>
                            {{ formatDate(sale.created_at) }}
                        </div>
                    </div>

                    <div style="text-align: right;">
                        <span class="badge-paid">PAYÉE</span>
                    </div>
                </td>
            </tr>
        </table>


        <!-- CLIENT -->
        <div class="client-box">
            <div class="client-label">
                Facturé à
            </div>

            <div class="client-name">
                {{ sale.client?.title }}
                {{ sale.client?.name }}
                {{ sale.client?.firstname }}
            </div>

            <div v-if="sale.client?.address" class="muted" style="margin-top: 4px;">
                {{ sale.client.address }}
            </div>

            <div v-if="sale.client?.town" class="muted">
                {{ sale.client.town }}
            </div>

            <div v-if="sale.client?.phone" class="muted">
                Tél. : {{ sale.client.phone }}
            </div>
        </div>


        <!-- PRODUITS -->
        <table class="products-table">
            <thead>
                <tr>
                    <th class="text-left">
                        Désignation
                    </th>

                    <th class="text-center" style="width: 70px;">
                        Qté
                    </th>

                    <th class="text-right" style="width: 120px;">
                        Prix unitaire
                    </th>

                    <th class="text-right" style="width: 120px;">
                        Total
                    </th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="detail in sale.saledetail" :key="detail.id">
                    <td>
                        <div class="fw-bold">
                            {{ detail.product.name_product }}
                        </div>

                        <div v-if="detail.product.reference" class="muted small">
                            Réf. {{ detail.product.reference }}
                        </div>
                    </td>

                    <td class="text-center">
                        {{ detail.quantity }}
                    </td>

                    <td class="text-right">
                        {{ formatPrice(detail.unit_price) }} Ar
                    </td>

                    <td class="text-right fw-bold">
                        {{ formatPrice(detail.total_line) }} Ar
                    </td>
                </tr>
            </tbody>
        </table>


        <!-- TOTAUX -->
        <div class="totals-wrapper">
            <table class="totals-table">
                <tr>
                    <td class="label">
                        Sous-total
                    </td>

                    <td class="value">
                        {{ formatPrice(subtotal) }} Ar
                    </td>
                </tr>

                <tr v-if="sale.discount > 0">
                    <td class="label">
                        Remise
                    </td>

                    <td class="value discount">
                        - {{ formatPrice(sale.discount) }} Ar
                    </td>
                </tr>

                <tr>
                    <td class="grand-label">
                        TOTAL
                    </td>

                    <td class="grand-value">
                        {{ formatPrice(sale.total_price) }} Ar
                    </td>
                </tr>
            </table>
        </div>


        <!-- INFOS -->
        <table class="info-table">
            <tr>
                <td>
                    <strong>Mode de paiement</strong>

                    {{ sale.payment_method }}
                </td>

                <td>
                    <template v-if="sale.note">
                        <strong>Note</strong>

                        {{ sale.note }}
                    </template>
                </td>
            </tr>
        </table>


        <!-- FOOTER -->
        <div class="footer">
            <div class="thanks">
                Merci pour votre confiance.
            </div>

            <div>
                {{ company.name }}
                — Facture {{ sale.sale_reference }}
            </div>
        </div>

    </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import html2pdf from 'html2pdf.js';
import { Share } from '#nativephp';
import axios from 'axios'; // ou utilise Inertia / fetch

const props = defineProps({
    company: { required: true },
    sale: { required: true },
});

const invoiceRef = ref(null);
const isGenerating = ref(false);

const subtotal = computed(() => {
    return props.sale.saledetail.reduce((total, detail) => {
        return total + Number(detail.total_line);
    }, 0);
});

const formatPrice = (value) => {
    return Number(value).toLocaleString('fr-FR', { maximumFractionDigits: 0 });
};

const formatDate = (date) => {
    if (!date) return '';
    return new Date(date).toLocaleDateString('fr-FR');
};

const generatePdf = async () => {
    if (!invoiceRef.value || isGenerating.value) return;

    isGenerating.value = true;

    try {
        // 1. Générer le Blob PDF
        const blob = await html2pdf()
            .set({
                margin: 10,
                filename: `facture-${props.sale.sale_reference}.pdf`,
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: {
                    scale: 2,
                    useCORS: true,
                    logging: false,
                },
                jsPDF: {
                    unit: 'mm',
                    format: 'a4',
                    orientation: 'portrait',
                },
            })
            .from(invoiceRef.value)
            .outputPdf('blob');

        // 2. Envoyer le Blob au backend pour le sauvegarder
        const formData = new FormData();
        formData.append('pdf', blob, `facture-${props.sale.sale_reference}.pdf`);
        formData.append('sale_reference', props.sale.sale_reference);

        const response = await axios.post('/ventes/invoice/savepdf', formData, {
            headers: { 'Content-Type': 'multipart/form-data' },
        });

        const filePath = response.data.path; // chemin absolu renvoyé par le backend

        // 3. Partager via le share sheet natif
        await Share.file(
            `Facture ${props.sale.sale_reference}`,
            'Voici votre facture.',
            filePath
        );

    } catch (error) {
        console.error(error); // même si tu ne le vois pas sur Jump

        let message = 'Erreur inconnue';

        if (error.response) {
            // Erreur HTTP (502, 500, 422…)
            message = `Status: ${error.response.status}\n`;
            message += JSON.stringify(error.response.data, null, 2);
        } else if (error.request) {
            message = 'Pas de réponse du serveur';
        } else {
            message = error.message;
        }

        alert(message); // ou Dialog.alert si tu as le plugin Dialog
    } finally {
        isGenerating.value = false;
    }
};
</script>

<style scoped>
* {
    margin: 0;
    padding: 0;
}

body {
    font-family: DejaVu Sans, Helvetica, Arial, sans-serif;
    font-size: 12px;
    color: #212529;
    line-height: 1.4;
}

.invoice-wrapper {
    padding: 24px;
}

/* En-tête */
.header-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 28px;
}

.header-table td {
    vertical-align: top;
}

.company-name {
    font-size: 16px;
    font-weight: bold;
    margin-bottom: 4px;
}

.muted {
    color: #6c757d;
}

.small {
    font-size: 11px;
}

.invoice-title {
    font-size: 26px;
    font-weight: bold;
    color: #0d6efd;
    text-align: right;
    margin-bottom: 8px;
}

.invoice-meta {
    text-align: right;
    font-size: 12px;
}

.badge-paid {
    display: inline-block;
    margin-top: 10px;
    padding: 4px 12px;
    background-color: #198754;
    color: #ffffff;
    font-size: 11px;
    font-weight: bold;
    text-align: center;
}

/* Bloc client */
.client-box {
    border: 1px solid #dee2e6;
    padding: 12px 14px;
    margin-bottom: 22px;
}

.client-label {
    font-size: 10px;
    text-transform: uppercase;
    color: #6c757d;
    font-weight: bold;
    margin-bottom: 6px;
}

.client-name {
    font-size: 14px;
    font-weight: bold;
}

/* Table produits */
.products-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

.products-table thead th {
    background-color: #212529;
    color: #ffffff;
    font-weight: bold;
    padding: 10px 8px;
    border: 1px solid #212529;
    font-size: 11px;
}

.products-table tbody td {
    padding: 10px 8px;
    border: 1px solid #dee2e6;
    vertical-align: top;
}

.text-center {
    text-align: center;
}

.text-right {
    text-align: right;
}

.text-left {
    text-align: left;
}

.fw-bold {
    font-weight: bold;
}

/* Totaux */
.totals-wrapper {
    width: 100%;
    margin-top: 10px;
    margin-bottom: 24px;
}

.totals-table {
    width: 42%;
    margin-left: auto;
    border-collapse: collapse;
    background-color: #f8f9fa;
}

.totals-table td {
    padding: 8px 12px;
    font-size: 12px;
}

.totals-table .label {
    color: #6c757d;
    text-align: left;
}

.totals-table .value {
    text-align: right;
}

.totals-table .discount {
    color: #dc3545;
}

.totals-table .grand-label {
    font-weight: bold;
    border-top: 1px solid #dee2e6;
    padding-top: 12px;
}

.totals-table .grand-value {
    font-size: 16px;
    font-weight: bold;
    color: #0d6efd;
    text-align: right;
    border-top: 1px solid #dee2e6;
    padding-top: 12px;
}

/* Infos bas */
.info-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 30px;
}

.info-table td {
    width: 50%;
    vertical-align: top;
    padding-right: 12px;
    font-size: 11px;
    color: #6c757d;
}

.info-table strong {
    color: #212529;
    display: block;
    margin-bottom: 4px;
}

/* Pied */
.footer {
    border-top: 1px solid #dee2e6;
    padding-top: 14px;
    text-align: center;
    font-size: 10px;
    color: #6c757d;
}

.footer .thanks {
    font-weight: bold;
    margin-bottom: 4px;
    color: #212529;
}
</style>