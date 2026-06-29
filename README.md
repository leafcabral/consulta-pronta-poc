![Logo do Consulta Pronta](docs/banner.png)

[![Link do Figma](https://img.shields.io/badge/Figma-Protótipo-e5d5b8?logo=figma&logoColor=white)](https://www.figma.com/design/E4iuqKu1mDYd7QhdtF63r1/ConsultaPronta--PI-?m=auto&t=djmWmG8K2mBZrBq3-1)
[![Link do Repósitorio do especificações desse projeto](https://img.shields.io/badge/Especificações-Repo-D0CEE5?logo=github)](https://github.com/leafcabral/consulta-pronta-spec)


ConsultaPronta é uma plataforma inteligente para triagem, direcionamento e acompanhamento da saúde do paciente, facilitando a comunicação com profissionais de saúde.

Esse repostitório apresenta uma implementação web reduzida do projeto ConsultaPronta com as funcionalidades principais do aplicativo, ao menos aquelas relacionadas com as tabelas principais dentro do banco de dados apresentado nas [especificações](https://github.com/leafcabral/consulta-pronta-spec).


> [!NOTE]  
> AS tecnologias utlizadas nessa implementação irão ser consideravelmente diferentes da implementação final


## Instalação
1. Instale o [USBWebserver](https://www.usbwebserver.net/webserver/) 8.6+.
2. Extrai ou clone o repositório dentro da pasta `root` do USBWebserver.
### Configurações necessárias
3. Execute o `usbwebserver.exe`.
4. Após selecionar a linguagem, vá em *Settings* e substitua o valor de *Root dir* para
```
{path}/root/consulta-pronta-poc/public
```
5. Salve, volte para a aba principal e selecione `PHPMyAdmin`.
6. Faça o login na página que foi aberta (usuário e senha padrão: *root* e *usbw*, respectivamente).
7. Selecione `SQL` no menu de navegação superior.
8. Execute os arquivos [generator.sql](db/generator.sql) e [populate.sql](db/generator.sql).

## Usando a plataforma
1. Execute o `usbwebserver.exe`.
2. Selecione `Localhost`.