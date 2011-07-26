<?php
class Produto extends AppModel {

	var $name = 'Produto';
	var $validate = array(
		'users_id' => array('numeric'), 
		'nome' => array(
			'nome' => array( 
				'rule' => array( 'notempty' ), 
				'message' => 'É obrigatório informar o nome do objeto/produto.', 
				'required' => true, 
				'allowEmpty' => false 
			), 
			'minimo' => array( 
				'rule' => array( 'minLength', 2 ),
				'message' => 'O nome do produto/objeto precisa ter no mínimo 2 dígitos, entretanto, recomendamos informar um nome descritivo, sem abreviações e caracteres especiais. 
								Exemplo: Iphone 3GS desbloqueado'
			),
			'maximo' => array( 
				'rule' => array( 'maxLength', 140 ),
				'message' => 'O nome do produto/objeto precisa ter no máximo 140 dígitos, se este limite não é o suficiente entre em contato com a equipe de atendimento.'
			),

		), 
		
		
		
		
		'comprimento' => array( 
			'preenchido' => array( 
				'rule' => array( 'minLength', 1 ), 
				'message' => "É obrigatório informar o comprimento do objeto/produto."
			),
			'numero' => array( 
				'rule' => array( 'numeric' ), 
				'message' => "O comprimento deve ser informado em formato numérico. Exemplo: Para vinte centímetros e meio digite 20.5"
			),
			'minimo' => array(
				'rule' => array( 'comparison', '>=', 16 ),
				'message' => "O comprimento minimo aceito é de 16 centimetros, se este limite não é suficiente entre em contato com a equipe de atendimento."
			),
			'maximo' => array(
				'rule' => array( 'comparison', '<=', 90 ),
				'message' => "O comprimento máximo aceito é de 90 centimetros, se este limite não é suficiente entre em contato com a equipe de atendimento."
			)
		), 
		
		'largura' => array(
			'preenchido' => array( 
				'rule' => array( 'minLength', 1 ), 
				'message' => "É obrigatório informar a largura do objeto/produto."
			),
			'numero' => array( 
				'rule' => array( 'numeric' ), 
				'message' => "A largura deve ser informada em formato numérico. Exemplo: Para vinte centímetros e meio digite 20.5"
			),
			'minimo' => array(
				'rule' => array( 'comparison', '>=', 5 ),
				'message' => "A largura minima é de 5 centimetros, se este limite não é suficiente entre em contato com a equipe de atendimento."
			),
			'maximo' => array(
				'rule' => array( 'comparison', '<=', 60 ),
				'message' => "A largura máxima é de 60 centimetros, se este limite não é suficiente entre em contato com a equipe de atendimento."
			)
		), 
		
		'altura' => array(
			'alturaMinima' => array( 
				'rule' => array( 'comparison', '>=', 2 ), 
				'message' => 'A altura precisa ter no mínimo 2 centímetros.'
			),
			'numero' => array( 
				'rule' => array( 'numeric' ), 
				'message' => "A altura deve ser informada em formato numérico. Exemplo: Para vinte centímetros e meio digite 20.5"
			),
			'maximo' => array(
				'rule' => array( 'comparison', '<=', 60 ),
				'message' => "A altura máxima aceita é de 60 centimetros, se este limite não é suficiente entre em contato com a equipe de atendimento."
			)
		
		), 
		/*
		'tamanho' => array(
			
			// Altura não pode ser maior que comprimento
			// A largura nao pode ser menor que 11cm, quando o comprimento for menor que 25cm
			// O comprimento nao pode ser inferior a 16 cm
			
			// CALCULOS
			// A soma resultante do comprimento + largura + algura não deve superar a 150 cm
			
		),
		*/
		'preco' => array(
			/**
			 * esta validação nao funcionou como esperado
			'money' => array(
				'rule' => array('money', 'right' ), 
				'message' => 'Informe o valor do produto.'
			),
			*/
			'minimo' => array(
				'rule' => array('comparison', '>=', 0.01 ), 
				'message' => 'O preço precisa ser maior que R$ 0,00 (zero). Exemplo: 0.01'
			),
			'maximo' => array(
				/**
				 * 1.000.000.00		10
				 * 100.000.00		9
				 * 10.000.00		8
				 * 1.000.00			7
				 */
				'rule' => array('maxLength', 7 ), 
				'message' => 'O preço máximo aceito é de R$ 9.999,99 (Nove mil, novecentos e noventa e nove reais e noventa e nove centavos). Se você precisa informar um valor maior entre em contato com a equipe de atendimento.'
			),

		), 
		'peso' => array(
			'comparacao1' => array( 
				'rule' => array( 'comparison', '>=', 0.300 ), 
				'message' => 'O peso precisa ter no mínimo 300 gramas (Exemplo: 0.300).'
			), 
			'comparacao2' => array( 
				'rule' => array( 'comparison', '<=', 30 ), 
				'message' => 'O peso precisa ter no máximo 30 quilos (Exemplo: 30).'
			), 
			
		), 
		'cep' => array(
			'numeric' => array(
	            'rule' => array('minLength', '8'),
	            'message' => 'O CEP precisa ter no mínimo 8 dígitos, digite apenas números.'
	         ), 
	         'notempty' => array(
	            'rule' => array('maxLength', '8'),
	            'message' => 'O CEP precisa ter no máximo 8 dígitos, digite apenas números.'
	         )
        ), 
        
        
        'envio_maximo' => array(
        	'numeric' => array(
        		'rule' => array( 'notempty' ),
        		'message' => 'É necessário informar quantas unidades do produto podem ser enviadas no mesmo pacote. A quantidade mínima por encomenda deve ser 1.',
        		'required' => true,
        		'allowEmpty' => false,
        	),
        ),
        
        /**
         * Validações para meios de envio
         */
        'envio_local' => array( 
        	'minimo' => array( 
        		'rule' => array( 'comparison', '<=', 2 ),
        		'message' => 'Você precisa informar se aceita a retirada do produto no local.'
        	),
        ),
        'envio_pac' => array( 
        	'notempty' => array( 
	        	'rule' => array( 'notempty' ),
	        	'message' => 'Informe se este produto pode ser enviado via PAC.'
	        ),
        ),
        'envio_sedex' => array( 
        	'notempty' => array( 
	        	'rule' => array( 'notempty' ),
	        	'message' => 'Informe se este produto pode ser enviado via SEDEX convencional.'
	        ),
        ),
        'envio_sedexacobrar' => array( 
        	'notempty' => array( 
	        	'rule' => array( 'notempty' ),
	        	'message' => 'Informe se este produto pode ser enviado via SEDEX a cobrar.'
	        ),
        ),
	);
	

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'users_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	
	var $hasMany = array(
	//var $hasAndBelongsToMany = array(
		'Opcao' => array(
			'className' => 'Opcao',
			'foreignKey' => 'produtos_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

}
?>