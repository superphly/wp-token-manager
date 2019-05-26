<div class="wrap">
  <h1 class="wp-heading-inline">Token Management</h1>
  <hr class="wp-header-end">

  <div class="card" style="margin-bottom: 1em">
		<h2 class="title">Your Ethereum Info</h2>
		<p><strong>Ethereum Address:</strong> <span class="myEtherAddress"></span></p>
	</div>

  <table class="widefat striped fixed" cellspacing="0" style="width: auto;">
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
    <tr class="holder"></tr>
  </table>
  <br>
  <a href="https://ropsten.etherscan.io/token/0xfed7020a24472aca24b1afa2f71a388c17f6634a">Token View on Etherscan</a>
</div>

<script id="row" type="text/x-jsrender">
  <tr>
    <td>{{:id}}</td>
    <td>{{:name}}</td>
    <td><a href="https://ropsten.etherscan.io/token/0xfed7020a24472aca24b1afa2f71a388c17f6634a?a={{:owner}}">{{:owner}}</a></td>
    <td><a href="https://ipfs.infura.io/ipfs/{{:ipfs}}">{{:ipfs}}</a></td>
    <td><a href="https://ropsten.etherscan.io/token/0xfed7020a24472aca24b1afa2f71a388c17f6634a?a={{:id}}">View</a></td>
    <td><a href="#" class="button button-primary">Transfer</a></td>
  </tr>
</script>

<script>
  jQuery(document).ready(function( $ ) {
    var tokens = [
      {
        id: 0,
        name: 'Johnny Johnson (Gold/Blue)',
        owner: '0x7DfEAd29A1BBE27cFA38Ba73f84872DB40932844',
        ipfs: 'QmSFxnK675wQ9Kc1uqWKyJUaNxvSc2BP5DbXCD3x93oq61'
      },
      {
        id: 1,
        name: 'Timmy Timmerson (Silver/Purple)',
        owner: '0x7DfEAd29A1BBE27cFA38Ba73f84872DB40932844',
        ipfs: 'QmdytmR4wULMd3SLo6ePF4s3WcRHWcpnJZ7bHhoj3QB13v'
      },
      {
        id: 2,
        name: 'Richard Rickards (Red/Black)',
        owner: '0x7DfEAd29A1BBE27cFA38Ba73f84872DB40932844',
        ipfs: 'QmSFxnK675wQ9Kc1uqWKyJUaNxvSc2BP5DbXCD3x93oq61'
      },      
    ]

    if (typeof web3 !== 'undefined') {
      web3 = new Web3(web3.currentProvider);
    } else {
      console.log('No web3? You should consider trying MetaMask!');
      web3 = new Web3(new Web3.providers.HttpProvider('http://localhost:8545'));
    }

    var row = $.templates('#row');

    function updateInterface() {
      var rows = row.render(tokens);
      $('tr.holder').replaceWith(rows);
      $('.myEtherAddress').replaceWith(web3.eth.accounts[0]);
    }

    web3.currentProvider.publicConfigStore.on('update', () => {
      $('.myEtherAddress').replaceWith(web3.eth.accounts[0]);
    });

    updateInterface();
  });
</script>