<div class="wrap">
	<h1 class="wp-heading-inline">Token Management</h1>
	<hr class="wp-header-end">

	<div id="infoCard" class="card" style="margin-bottom: 1em">

	</div>

	<table id="tokenTable" class="widefat striped fixed" cellspacing="0" style="width: auto;">
		<thead>
			<tr>
				<th>ID</th>
				<th>Asset Name</th>
				<th>Owner (Address)</th>
				<th>Hash</th>
				<th>Etherscan</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
	<br>
	<a href="https://ropsten.etherscan.io/token/0xfed7020a24472aca24b1afa2f71a388c17f6634a">Token View on Etherscan</a>
</div>

<script id="tokenRow" type="text/x-jsrender">
	<tr>
		<td>{{:id}}</td>
		<td>{{:json.name}}</td>
		<td><a href="https://ropsten.etherscan.io/token/0xfed7020a24472aca24b1afa2f71a388c17f6634a?a={{:owner}}">{{:owner}}</a></td>
		<td><a href="https://ipfs.infura.io/ipfs/{{:ipfs}}">{{:ipfs}}</a></td>
		<td><a href="https://ropsten.etherscan.io/token/0xfed7020a24472aca24b1afa2f71a388c17f6634a?a={{:id}}">View</a></td>
		<td><a href="#" class="button button-primary" onClick="transfer({{:id}})">Transfer</a></td>
	</tr>
</script>

<script id="infoCardContent" type="text/x-jsrender">
	<h2 class="title">Your Ethereum Info</h2>
	<p>
		<strong>Ethereum Address:</strong> {{:currentAddress}}<br>
		<strong>Balance:</strong> {{:balance}}
	</p>
</script>

<script defer>
	// Web 3 initialization and contract setup
	function web3init() {
		if (typeof web3 !== 'undefined') {
			web3 = new Web3(web3.currentProvider);
		} else {
			console.log('No web3? You should consider trying MetaMask!');
			web3 = new Web3(new Web3.providers.HttpProvider('http://localhost:8545'));
		}

		// Setup Smart Contact
		var abi = [{"constant":false,"inputs":[{"name":"account","type":"address"}],"name":"addMinter","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"to","type":"address"},{"name":"tokenId","type":"uint256"}],"name":"approve","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"tokenId","type":"uint256"}],"name":"burn","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"to","type":"address"},{"name":"tokenId","type":"uint256"}],"name":"mint","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"to","type":"address"},{"name":"tokenId","type":"uint256"},{"name":"tokenURI","type":"string"}],"name":"mintWithTokenURI","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[],"name":"renounceMinter","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"from","type":"address"},{"name":"to","type":"address"},{"name":"tokenId","type":"uint256"}],"name":"safeTransferFrom","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"from","type":"address"},{"name":"to","type":"address"},{"name":"tokenId","type":"uint256"},{"name":"_data","type":"bytes"}],"name":"safeTransferFrom","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"to","type":"address"},{"name":"approved","type":"bool"}],"name":"setApprovalForAll","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"tokenId","type":"uint256"},{"name":"uri","type":"string"}],"name":"setTokenURI","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"from","type":"address"},{"name":"to","type":"address"},{"name":"tokenId","type":"uint256"}],"name":"transferFrom","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"inputs":[{"name":"name","type":"string"},{"name":"symbol","type":"string"}],"payable":false,"stateMutability":"nonpayable","type":"constructor"},{"anonymous":false,"inputs":[{"indexed":true,"name":"account","type":"address"}],"name":"MinterAdded","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"account","type":"address"}],"name":"MinterRemoved","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"from","type":"address"},{"indexed":true,"name":"to","type":"address"},{"indexed":true,"name":"tokenId","type":"uint256"}],"name":"Transfer","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"owner","type":"address"},{"indexed":true,"name":"approved","type":"address"},{"indexed":true,"name":"tokenId","type":"uint256"}],"name":"Approval","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"owner","type":"address"},{"indexed":true,"name":"operator","type":"address"},{"indexed":false,"name":"approved","type":"bool"}],"name":"ApprovalForAll","type":"event"},{"constant":true,"inputs":[{"name":"owner","type":"address"}],"name":"balanceOf","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"name":"tokenId","type":"uint256"}],"name":"exists","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"name":"tokenId","type":"uint256"}],"name":"getApproved","outputs":[{"name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"name":"owner","type":"address"},{"name":"operator","type":"address"}],"name":"isApprovedForAll","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"name":"account","type":"address"}],"name":"isMinter","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"name","outputs":[{"name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"name":"tokenId","type":"uint256"}],"name":"ownerOf","outputs":[{"name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"name":"interfaceId","type":"bytes4"}],"name":"supportsInterface","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"symbol","outputs":[{"name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"name":"index","type":"uint256"}],"name":"tokenByIndex","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"name":"owner","type":"address"},{"name":"index","type":"uint256"}],"name":"tokenOfOwnerByIndex","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"name":"owner","type":"address"}],"name":"tokensOfOwner","outputs":[{"name":"","type":"uint256[]"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"name":"tokenId","type":"uint256"}],"name":"tokenURI","outputs":[{"name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"totalSupply","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"}];
		var registryContract = web3.eth.contract(abi);
		registry = registryContract.at('0xfED7020A24472aca24b1AfA2f71a388C17F6634A');

		web3.currentProvider.publicConfigStore.on('update', updateInfoCard);
	}

	// UI Update Functions
	async function updateInfoCard() {
		return new Promise((resolve, reject) => {
			var [currentAddress] = web3.eth.accounts;

			web3.eth.getBalance(currentAddress, (e, balance) => {
				if (e) return reject(e)
				balance = web3.fromWei(balance, 'ether')
				var infoCardTemplate = jQuery.templates('#infoCardContent');
				var infoCardContent = infoCardTemplate({ balance, currentAddress });
				jQuery('div#infoCard').empty().html(infoCardContent);
				resolve()
			});
		})
	}

	class Http {

		static _error({ response }) {
			var { status: code, statusText: text, data } = response
			var status = { code, text }
			return { status, data }
		}

		static _success({ data }) {
			return data
		}
		
		static async GET({ url, options }) {
			try {
				var { data } = await axios.get(url, options)
				return data  //Uncaught SyntaxError: missing ) after argument list
			} catch(e) {
				throw Http._error(resp)
			}
		}

	}

	async function updateTokenTable() {
		var dir = '<?php echo plugins_url(); ?>';

		function getFromRegistry(id, method) {
			return new Promise((resolve, reject) => {
				registry[method](id, (e,r) => {
					if (e)
						return reject(e)
					resolve(r)
				})
			})
		}

		async function getTokenData() {
			try {
				var ids = await Http.GET({ url: `/wp-json/wp/v2/post` })
				var data = []
				var owner, ipfs, json
				for (var { token_number: id } of ids) {
					owner = await getFromRegistry(id, 'ownerOf')
					ipfs = await getFromRegistry(id, 'tokenURI')
					json = await Http.GET({ url: `${dir}/wp-token-manager/json/${id}.json` })
					data.push({ id, ipfs, owner, json })
				}
				return data
			} catch(e) {
				console.log(e)
			}
		}
	
		var tokens = await getTokenData()
		console.log(tokens)
		var tokenRowTemplate = jQuery.templates('#tokenRow');
		var tokenRows = tokenRowTemplate.render(tokens);
		jQuery('table#tokenTable tbody').empty().html(tokenRows);
	}

	function transfer(id) {
		var toAddress = prompt('Ether Address to send to', '0xABCD');
		registry.transferFrom(web3.eth.defaultAccount, toAddress, id, (e,r) => {
			console.log('sent')
		});
	}

	var wait = (ms) => new Promise(r => setTimeout(r, ms))

	var registry;
	web3init();

	(async () => {
		try {
			await wait(500)
			updateInfoCard();
			updateTokenTable();
		} catch(e) {
			console.log('fook')
		}
	})()
</script>