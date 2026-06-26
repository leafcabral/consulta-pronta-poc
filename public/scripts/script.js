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