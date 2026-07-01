async function hash(message) {
	const msgBuffer = new TextEncoder().encode(message);
	const hashBuffer = await crypto.subtle.digest('SHA-256', msgBuffer);
	const hashArray = Array.from(new Uint8Array(hashBuffer));
	const hashHex = hashArray.map(b => ('00' + b.toString(16)).slice(-2)).join('');

	return hashHex;
}

function format_cpf(value) {
	return value
		.replace(/\D/g, '') // Remove qualquer coisa que não seja número
		.replace(/(\d{3})(\d)/, '$1.$2') // Adiciona ponto após o terceiro dígito
		.replace(/(\d{3})(\d)/, '$1.$2') // Adiciona ponto após o sexto dígito
		.replace(/(\d{3})(\d)/, '$1-$2') // Adiciona traço após o nono dígito
		.replace(/(-\d{2})\d+?$/, '$1'); // Impede entrada de mais de 11 dígitos
}

const ReportAPI = {
	// Seria bom juntar em um só
	urlGet: '/api/relatorio_completo.php',
	url: '/api/relatorio.php',

	async get(id) {
		const args = `?id=${id}`
		const response = await fetch(this.urlGet + args)

		if (!response.ok) throw new Error("Erro ao buscar o relatório bruh")
		return await response.text();
	},

	async create(id) {
		throw new Error("Alguem poderia fazer isso aqui né @calielian")
	},

	async update(id) {
		throw new Error("Alguem poderia fazer isso aqui né @vitor.felberh")
	},

	async delete(id) {
		const response = await fetch(this.url, {
			method: "POST",
			headers: { "Content-Type": "application/json" },
			body: JSON.stringify(
				{ action: "delete", id }
			)
		});

		const result = await response.json();
		console.log(result.message); 
	}
}