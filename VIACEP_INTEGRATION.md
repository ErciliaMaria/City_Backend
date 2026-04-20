# Integração ViaCEP - Documentação

## Overview
A integração com a API ViaCEP permite buscar automaticamente dados de cidades (nome, DDD e código IBGE) a partir do CEP.

## Endpoints

### Search by CEP
Busca dados de uma cidade pelo CEP.

**Método:** `POST`  
**URL:** `/api/v1/cep/search`  
**Content-Type:** `application/json`

#### Request
```json
{
  "cep": "01310100"
}
```

#### Parâmetros
| Parâmetro | Tipo   | Obrigatório | Descrição              |
|-----------|--------|-------------|------------------------|
| cep       | string | Sim         | CEP com 8 ou 9 dígitos |

#### Response (Sucesso - 200)
```json
{
  "success": true,
  "message": "CEP data fetched successfully",
  "data": {
    "cep": "01310-100",
    "nome": "São Paulo",
    "ddd": 11,
    "codigo_ibge": "3550308",
    "uf": "SP",
    "bairro": "Centro",
    "logradouro": "Avenida Paulista"
  }
}
```

#### Response (CEP não encontrado - 404)
```json
{
  "success": false,
  "message": "CEP not found",
  "data": null
}
```

#### Response (Erro de validação - 400/422)
```json
{
  "success": false,
  "message": "CEP must have 8 digits",
  "data": null
}
```

## Exemplos de Uso

### cURL
```bash
curl -X POST http://localhost/api/v1/cep/search \
  -H "Content-Type: application/json" \
  -d '{"cep": "01310100"}'
```

### JavaScript/Fetch
```javascript
fetch('/api/v1/cep/search', {
  method: 'POST',
  headers: {
    'Content-Type': 'application/json',
  },
  body: JSON.stringify({
    cep: '01310100'
  })
})
.then(response => response.json())
.then(data => console.log(data))
.catch(error => console.error('Error:', error));
```

### Axios
```javascript
axios.post('/api/v1/cep/search', {
  cep: '01310100'
})
.then(response => console.log(response.data))
.catch(error => console.error('Error:', error));
```

## Campos Retornados

| Campo       | Tipo    | Descrição                    |
|-------------|---------|------------------------------|
| cep         | string  | CEP formatado (XXXXX-XXX)   |
| nome        | string  | Nome da cidade               |
| ddd         | integer | Código de discagem direto    |
| codigo_ibge | string  | Código IBGE da cidade       |
| uf          | string  | Sigla do estado (ex: SP)    |
| bairro      | string  | Bairro (se disponível)      |
| logradouro  | string  | Logradouro (se disponível) |

## Tratamento de Erros

### Validação
- CEP deve ter 8 dígitos (caracteres não-numéricos são removidos)
- CEP é obrigatório
- Retorna erro 422 se validação falhar

### CEP Não Encontrado
- Retorna erro 404 se o CEP não existir na base da ViaCEP

### Erro de Conexão
- Retorna erro 400 se houver problema ao conectar com ViaCEP
- Timeout de 5 segundos configurado

## Implementação no Frontend (Vue.js)

```vue
<script setup>
import { ref } from 'vue'

const cep = ref('')
const loading = ref(false)
const cityData = ref(null)
const error = ref(null)

const searchCep = async () => {
  if (!cep.value || cep.value.length < 8) {
    error.value = 'CEP inválido'
    return
  }

  loading.value = true
  error.value = null
  cityData.value = null

  try {
    const response = await fetch('/api/v1/cep/search', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ cep: cep.value })
    })

    const data = await response.json()

    if (data.success) {
      cityData.value = data.data
    } else {
      error.value = data.message
    }
  } catch (err) {
    error.value = 'Erro ao buscar CEP'
  } finally {
    loading.value = false
  }
}
</script>

<template>
  <div class="cep-search">
    <input
      v-model="cep"
      placeholder="Digite o CEP (8 dígitos)"
      @keyup.enter="searchCep"
    />
    <button @click="searchCep" :disabled="loading">
      {{ loading ? 'Buscando...' : 'Buscar' }}
    </button>

    <div v-if="error" class="error">{{ error }}</div>

    <div v-if="cityData" class="results">
      <p><strong>Cidade:</strong> {{ cityData.nome }}</p>
      <p><strong>UF:</strong> {{ cityData.uf }}</p>
      <p><strong>DDD:</strong> {{ cityData.ddd }}</p>
      <p><strong>Código IBGE:</strong> {{ cityData.codigo_ibge }}</p>
      <p v-if="cityData.bairro"><strong>Bairro:</strong> {{ cityData.bairro }}</p>
      <p v-if="cityData.logradouro"><strong>Logradouro:</strong> {{ cityData.logradouro }}</p>
    </div>
  </div>
</template>
```

## Notas

- A ViaCEP é uma API pública e gratuita
- Não há limite de requisições, mas é recomendado não fazer muitas requisições simultâneas
- Os dados são atualizados regularmente pela ViaCEP
- A API responde em JSON
- Timeout de 5 segundos configurado para evitar travamentos
