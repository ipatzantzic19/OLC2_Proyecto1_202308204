<?php

/*
 * Generated from Golampi.g4 by ANTLR 4.9.2
 */

namespace {
	use Antlr\Antlr4\Runtime\Atn\ATN;
	use Antlr\Antlr4\Runtime\Atn\ATNDeserializer;
	use Antlr\Antlr4\Runtime\Atn\ParserATNSimulator;
	use Antlr\Antlr4\Runtime\Dfa\DFA;
	use Antlr\Antlr4\Runtime\Error\Exceptions\FailedPredicateException;
	use Antlr\Antlr4\Runtime\Error\Exceptions\NoViableAltException;
	use Antlr\Antlr4\Runtime\PredictionContexts\PredictionContextCache;
	use Antlr\Antlr4\Runtime\Error\Exceptions\RecognitionException;
	use Antlr\Antlr4\Runtime\RuleContext;
	use Antlr\Antlr4\Runtime\Token;
	use Antlr\Antlr4\Runtime\TokenStream;
	use Antlr\Antlr4\Runtime\Vocabulary;
	use Antlr\Antlr4\Runtime\VocabularyImpl;
	use Antlr\Antlr4\Runtime\RuntimeMetaData;
	use Antlr\Antlr4\Runtime\Parser;

	final class GolampiParser extends Parser
	{
		public const T__0 = 1, T__1 = 2, T__2 = 3, T__3 = 4, T__4 = 5, T__5 = 6, 
               T__6 = 7, T__7 = 8, T__8 = 9, T__9 = 10, T__10 = 11, T__11 = 12, 
               T__12 = 13, T__13 = 14, T__14 = 15, T__15 = 16, T__16 = 17, 
               T__17 = 18, T__18 = 19, T__19 = 20, T__20 = 21, T__21 = 22, 
               T__22 = 23, T__23 = 24, T__24 = 25, T__25 = 26, T__26 = 27, 
               T__27 = 28, T__28 = 29, T__29 = 30, T__30 = 31, VAR = 32, 
               CONST = 33, FUNC = 34, IF = 35, ELSE = 36, SWITCH = 37, CASE = 38, 
               DEFAULT = 39, FOR = 40, BREAK = 41, CONTINUE = 42, RETURN = 43, 
               TRUE = 44, FALSE = 45, NIL = 46, AND = 47, OR = 48, RANGE = 49, 
               INT32 = 50, FLOAT32 = 51, RUNE = 52, STRING = 53, ID = 54, 
               LINE_COMMENT = 55, BLOCK_COMMENT = 56, WS = 57;

		public const RULE_program = 0, RULE_declaration = 1, RULE_varDeclaration = 2, 
               RULE_shortVarDeclaration = 3, RULE_constDeclaration = 4, 
               RULE_functionDeclaration = 5, RULE_parameterList = 6, RULE_parameter = 7, 
               RULE_typeList = 8, RULE_idList = 9, RULE_expressionList = 10, 
               RULE_statement = 11, RULE_assignment = 12, RULE_assignOp = 13, 
               RULE_incDecStatement = 14, RULE_ifStatement = 15, RULE_switchStatement = 16, 
               RULE_caseClause = 17, RULE_caseExpressionList = 18, RULE_caseExpression = 19, 
               RULE_defaultClause = 20, RULE_forStatement = 21, RULE_forClause = 22, 
               RULE_forInit = 23, RULE_forPost = 24, RULE_breakStatement = 25, 
               RULE_continueStatement = 26, RULE_returnStatement = 27, RULE_block = 28, 
               RULE_expressionStatement = 29, RULE_expression = 30, RULE_logicalOr = 31, 
               RULE_logicalAnd = 32, RULE_equality = 33, RULE_relational = 34, 
               RULE_additive = 35, RULE_multiplicative = 36, RULE_unary = 37, 
               RULE_primary = 38, RULE_arrayLiteral = 39, RULE_innerLiteralList = 40, 
               RULE_innerLiteral = 41, RULE_argumentList = 42, RULE_argument = 43, 
               RULE_type = 44;

		/**
		 * @var array<string>
		 */
		public const RULE_NAMES = [
			'program', 'declaration', 'varDeclaration', 'shortVarDeclaration', 'constDeclaration', 
			'functionDeclaration', 'parameterList', 'parameter', 'typeList', 'idList', 
			'expressionList', 'statement', 'assignment', 'assignOp', 'incDecStatement', 
			'ifStatement', 'switchStatement', 'caseClause', 'caseExpressionList', 
			'caseExpression', 'defaultClause', 'forStatement', 'forClause', 'forInit', 
			'forPost', 'breakStatement', 'continueStatement', 'returnStatement', 
			'block', 'expressionStatement', 'expression', 'logicalOr', 'logicalAnd', 
			'equality', 'relational', 'additive', 'multiplicative', 'unary', 'primary', 
			'arrayLiteral', 'innerLiteralList', 'innerLiteral', 'argumentList', 'argument', 
			'type'
		];

		/**
		 * @var array<string|null>
		 */
		private const LITERAL_NAMES = [
		    null, "'='", "':='", "'('", "')'", "','", "'*'", "'['", "']'", "'+='", 
		    "'-='", "'*='", "'/='", "'++'", "'--'", "'{'", "'}'", "':'", "';'", 
		    "'=='", "'!='", "'>'", "'>='", "'<'", "'<='", "'+'", "'-'", "'/'", 
		    "'%'", "'!'", "'&'", "'.'", "'var'", "'const'", "'func'", "'if'", 
		    "'else'", "'switch'", "'case'", "'default'", "'for'", "'break'", "'continue'", 
		    "'return'", "'true'", "'false'", "'nil'", "'&&'", "'||'", "'..'"
		];

		/**
		 * @var array<string>
		 */
		private const SYMBOLIC_NAMES = [
		    null, null, null, null, null, null, null, null, null, null, null, 
		    null, null, null, null, null, null, null, null, null, null, null, 
		    null, null, null, null, null, null, null, null, null, null, "VAR", 
		    "CONST", "FUNC", "IF", "ELSE", "SWITCH", "CASE", "DEFAULT", "FOR", 
		    "BREAK", "CONTINUE", "RETURN", "TRUE", "FALSE", "NIL", "AND", "OR", 
		    "RANGE", "INT32", "FLOAT32", "RUNE", "STRING", "ID", "LINE_COMMENT", 
		    "BLOCK_COMMENT", "WS"
		];

		/**
		 * @var string
		 */
		private const SERIALIZED_ATN =
			"\u{3}\u{608B}\u{A72A}\u{8133}\u{B9ED}\u{417C}\u{3BE7}\u{7786}\u{5964}" .
		    "\u{3}\u{3B}\u{204}\u{4}\u{2}\u{9}\u{2}\u{4}\u{3}\u{9}\u{3}\u{4}\u{4}" .
		    "\u{9}\u{4}\u{4}\u{5}\u{9}\u{5}\u{4}\u{6}\u{9}\u{6}\u{4}\u{7}\u{9}" .
		    "\u{7}\u{4}\u{8}\u{9}\u{8}\u{4}\u{9}\u{9}\u{9}\u{4}\u{A}\u{9}\u{A}" .
		    "\u{4}\u{B}\u{9}\u{B}\u{4}\u{C}\u{9}\u{C}\u{4}\u{D}\u{9}\u{D}\u{4}" .
		    "\u{E}\u{9}\u{E}\u{4}\u{F}\u{9}\u{F}\u{4}\u{10}\u{9}\u{10}\u{4}\u{11}" .
		    "\u{9}\u{11}\u{4}\u{12}\u{9}\u{12}\u{4}\u{13}\u{9}\u{13}\u{4}\u{14}" .
		    "\u{9}\u{14}\u{4}\u{15}\u{9}\u{15}\u{4}\u{16}\u{9}\u{16}\u{4}\u{17}" .
		    "\u{9}\u{17}\u{4}\u{18}\u{9}\u{18}\u{4}\u{19}\u{9}\u{19}\u{4}\u{1A}" .
		    "\u{9}\u{1A}\u{4}\u{1B}\u{9}\u{1B}\u{4}\u{1C}\u{9}\u{1C}\u{4}\u{1D}" .
		    "\u{9}\u{1D}\u{4}\u{1E}\u{9}\u{1E}\u{4}\u{1F}\u{9}\u{1F}\u{4}\u{20}" .
		    "\u{9}\u{20}\u{4}\u{21}\u{9}\u{21}\u{4}\u{22}\u{9}\u{22}\u{4}\u{23}" .
		    "\u{9}\u{23}\u{4}\u{24}\u{9}\u{24}\u{4}\u{25}\u{9}\u{25}\u{4}\u{26}" .
		    "\u{9}\u{26}\u{4}\u{27}\u{9}\u{27}\u{4}\u{28}\u{9}\u{28}\u{4}\u{29}" .
		    "\u{9}\u{29}\u{4}\u{2A}\u{9}\u{2A}\u{4}\u{2B}\u{9}\u{2B}\u{4}\u{2C}" .
		    "\u{9}\u{2C}\u{4}\u{2D}\u{9}\u{2D}\u{4}\u{2E}\u{9}\u{2E}\u{3}\u{2}" .
		    "\u{7}\u{2}\u{5E}\u{A}\u{2}\u{C}\u{2}\u{E}\u{2}\u{61}\u{B}\u{2}\u{3}" .
		    "\u{2}\u{3}\u{2}\u{3}\u{3}\u{3}\u{3}\u{3}\u{3}\u{3}\u{3}\u{5}\u{3}" .
		    "\u{69}\u{A}\u{3}\u{3}\u{4}\u{3}\u{4}\u{3}\u{4}\u{3}\u{4}\u{3}\u{4}" .
		    "\u{3}\u{4}\u{3}\u{4}\u{3}\u{4}\u{3}\u{4}\u{3}\u{4}\u{5}\u{4}\u{75}" .
		    "\u{A}\u{4}\u{3}\u{5}\u{3}\u{5}\u{3}\u{5}\u{3}\u{5}\u{3}\u{6}\u{3}" .
		    "\u{6}\u{3}\u{6}\u{3}\u{6}\u{3}\u{6}\u{3}\u{6}\u{3}\u{7}\u{3}\u{7}" .
		    "\u{3}\u{7}\u{3}\u{7}\u{5}\u{7}\u{85}\u{A}\u{7}\u{3}\u{7}\u{3}\u{7}" .
		    "\u{5}\u{7}\u{89}\u{A}\u{7}\u{3}\u{7}\u{3}\u{7}\u{3}\u{7}\u{3}\u{7}" .
		    "\u{3}\u{7}\u{5}\u{7}\u{90}\u{A}\u{7}\u{3}\u{7}\u{3}\u{7}\u{3}\u{7}" .
		    "\u{3}\u{7}\u{3}\u{7}\u{3}\u{7}\u{5}\u{7}\u{98}\u{A}\u{7}\u{3}\u{8}" .
		    "\u{3}\u{8}\u{3}\u{8}\u{7}\u{8}\u{9D}\u{A}\u{8}\u{C}\u{8}\u{E}\u{8}" .
		    "\u{A0}\u{B}\u{8}\u{3}\u{9}\u{3}\u{9}\u{3}\u{9}\u{3}\u{9}\u{3}\u{9}" .
		    "\u{5}\u{9}\u{A7}\u{A}\u{9}\u{3}\u{A}\u{3}\u{A}\u{3}\u{A}\u{7}\u{A}" .
		    "\u{AC}\u{A}\u{A}\u{C}\u{A}\u{E}\u{A}\u{AF}\u{B}\u{A}\u{3}\u{B}\u{3}" .
		    "\u{B}\u{3}\u{B}\u{7}\u{B}\u{B4}\u{A}\u{B}\u{C}\u{B}\u{E}\u{B}\u{B7}" .
		    "\u{B}\u{B}\u{3}\u{C}\u{3}\u{C}\u{3}\u{C}\u{7}\u{C}\u{BC}\u{A}\u{C}" .
		    "\u{C}\u{C}\u{E}\u{C}\u{BF}\u{B}\u{C}\u{3}\u{D}\u{3}\u{D}\u{3}\u{D}" .
		    "\u{3}\u{D}\u{3}\u{D}\u{3}\u{D}\u{3}\u{D}\u{3}\u{D}\u{3}\u{D}\u{3}" .
		    "\u{D}\u{3}\u{D}\u{5}\u{D}\u{CC}\u{A}\u{D}\u{3}\u{E}\u{3}\u{E}\u{3}" .
		    "\u{E}\u{3}\u{E}\u{3}\u{E}\u{3}\u{E}\u{3}\u{E}\u{3}\u{E}\u{3}\u{E}" .
		    "\u{6}\u{E}\u{D7}\u{A}\u{E}\u{D}\u{E}\u{E}\u{E}\u{D8}\u{3}\u{E}\u{3}" .
		    "\u{E}\u{3}\u{E}\u{3}\u{E}\u{3}\u{E}\u{3}\u{E}\u{3}\u{E}\u{3}\u{E}" .
		    "\u{5}\u{E}\u{E3}\u{A}\u{E}\u{3}\u{F}\u{3}\u{F}\u{3}\u{10}\u{3}\u{10}" .
		    "\u{3}\u{10}\u{3}\u{10}\u{5}\u{10}\u{EB}\u{A}\u{10}\u{3}\u{11}\u{3}" .
		    "\u{11}\u{3}\u{11}\u{3}\u{11}\u{3}\u{11}\u{3}\u{11}\u{3}\u{11}\u{3}" .
		    "\u{11}\u{7}\u{11}\u{F5}\u{A}\u{11}\u{C}\u{11}\u{E}\u{11}\u{F8}\u{B}" .
		    "\u{11}\u{3}\u{11}\u{3}\u{11}\u{5}\u{11}\u{FC}\u{A}\u{11}\u{3}\u{12}" .
		    "\u{3}\u{12}\u{3}\u{12}\u{3}\u{12}\u{7}\u{12}\u{102}\u{A}\u{12}\u{C}" .
		    "\u{12}\u{E}\u{12}\u{105}\u{B}\u{12}\u{3}\u{12}\u{5}\u{12}\u{108}\u{A}" .
		    "\u{12}\u{3}\u{12}\u{3}\u{12}\u{3}\u{13}\u{3}\u{13}\u{3}\u{13}\u{3}" .
		    "\u{13}\u{7}\u{13}\u{110}\u{A}\u{13}\u{C}\u{13}\u{E}\u{13}\u{113}\u{B}" .
		    "\u{13}\u{3}\u{14}\u{3}\u{14}\u{3}\u{14}\u{7}\u{14}\u{118}\u{A}\u{14}" .
		    "\u{C}\u{14}\u{E}\u{14}\u{11B}\u{B}\u{14}\u{3}\u{15}\u{3}\u{15}\u{3}" .
		    "\u{15}\u{3}\u{15}\u{3}\u{15}\u{5}\u{15}\u{122}\u{A}\u{15}\u{3}\u{16}" .
		    "\u{3}\u{16}\u{3}\u{16}\u{7}\u{16}\u{127}\u{A}\u{16}\u{C}\u{16}\u{E}" .
		    "\u{16}\u{12A}\u{B}\u{16}\u{3}\u{17}\u{3}\u{17}\u{3}\u{17}\u{3}\u{17}" .
		    "\u{3}\u{17}\u{3}\u{17}\u{3}\u{17}\u{3}\u{17}\u{3}\u{17}\u{3}\u{17}" .
		    "\u{5}\u{17}\u{136}\u{A}\u{17}\u{3}\u{18}\u{3}\u{18}\u{3}\u{18}\u{5}" .
		    "\u{18}\u{13B}\u{A}\u{18}\u{3}\u{18}\u{3}\u{18}\u{3}\u{18}\u{3}\u{19}" .
		    "\u{3}\u{19}\u{3}\u{19}\u{3}\u{19}\u{3}\u{19}\u{5}\u{19}\u{145}\u{A}" .
		    "\u{19}\u{3}\u{1A}\u{3}\u{1A}\u{3}\u{1A}\u{5}\u{1A}\u{14A}\u{A}\u{1A}" .
		    "\u{3}\u{1B}\u{3}\u{1B}\u{3}\u{1C}\u{3}\u{1C}\u{3}\u{1D}\u{3}\u{1D}" .
		    "\u{5}\u{1D}\u{152}\u{A}\u{1D}\u{3}\u{1E}\u{3}\u{1E}\u{7}\u{1E}\u{156}" .
		    "\u{A}\u{1E}\u{C}\u{1E}\u{E}\u{1E}\u{159}\u{B}\u{1E}\u{3}\u{1E}\u{3}" .
		    "\u{1E}\u{3}\u{1F}\u{3}\u{1F}\u{3}\u{20}\u{3}\u{20}\u{3}\u{21}\u{3}" .
		    "\u{21}\u{3}\u{21}\u{7}\u{21}\u{164}\u{A}\u{21}\u{C}\u{21}\u{E}\u{21}" .
		    "\u{167}\u{B}\u{21}\u{3}\u{22}\u{3}\u{22}\u{3}\u{22}\u{7}\u{22}\u{16C}" .
		    "\u{A}\u{22}\u{C}\u{22}\u{E}\u{22}\u{16F}\u{B}\u{22}\u{3}\u{23}\u{3}" .
		    "\u{23}\u{3}\u{23}\u{7}\u{23}\u{174}\u{A}\u{23}\u{C}\u{23}\u{E}\u{23}" .
		    "\u{177}\u{B}\u{23}\u{3}\u{24}\u{3}\u{24}\u{3}\u{24}\u{7}\u{24}\u{17C}" .
		    "\u{A}\u{24}\u{C}\u{24}\u{E}\u{24}\u{17F}\u{B}\u{24}\u{3}\u{25}\u{3}" .
		    "\u{25}\u{3}\u{25}\u{7}\u{25}\u{184}\u{A}\u{25}\u{C}\u{25}\u{E}\u{25}" .
		    "\u{187}\u{B}\u{25}\u{3}\u{26}\u{3}\u{26}\u{3}\u{26}\u{7}\u{26}\u{18C}" .
		    "\u{A}\u{26}\u{C}\u{26}\u{E}\u{26}\u{18F}\u{B}\u{26}\u{3}\u{27}\u{3}" .
		    "\u{27}\u{3}\u{27}\u{3}\u{27}\u{3}\u{27}\u{3}\u{27}\u{3}\u{27}\u{3}" .
		    "\u{27}\u{3}\u{27}\u{5}\u{27}\u{19A}\u{A}\u{27}\u{3}\u{28}\u{3}\u{28}" .
		    "\u{3}\u{28}\u{3}\u{28}\u{3}\u{28}\u{3}\u{28}\u{3}\u{28}\u{3}\u{28}" .
		    "\u{3}\u{28}\u{3}\u{28}\u{5}\u{28}\u{1A6}\u{A}\u{28}\u{3}\u{28}\u{3}" .
		    "\u{28}\u{5}\u{28}\u{1AA}\u{A}\u{28}\u{3}\u{28}\u{3}\u{28}\u{3}\u{28}" .
		    "\u{3}\u{28}\u{3}\u{28}\u{3}\u{28}\u{6}\u{28}\u{1B2}\u{A}\u{28}\u{D}" .
		    "\u{28}\u{E}\u{28}\u{1B3}\u{3}\u{28}\u{3}\u{28}\u{3}\u{28}\u{3}\u{28}" .
		    "\u{3}\u{28}\u{3}\u{28}\u{3}\u{28}\u{3}\u{28}\u{3}\u{28}\u{3}\u{28}" .
		    "\u{5}\u{28}\u{1C0}\u{A}\u{28}\u{3}\u{29}\u{3}\u{29}\u{3}\u{29}\u{3}" .
		    "\u{29}\u{3}\u{29}\u{3}\u{29}\u{3}\u{29}\u{5}\u{29}\u{1C9}\u{A}\u{29}" .
		    "\u{3}\u{29}\u{3}\u{29}\u{3}\u{29}\u{3}\u{29}\u{3}\u{29}\u{3}\u{29}" .
		    "\u{3}\u{29}\u{5}\u{29}\u{1D2}\u{A}\u{29}\u{3}\u{29}\u{3}\u{29}\u{5}" .
		    "\u{29}\u{1D6}\u{A}\u{29}\u{3}\u{2A}\u{3}\u{2A}\u{3}\u{2A}\u{7}\u{2A}" .
		    "\u{1DB}\u{A}\u{2A}\u{C}\u{2A}\u{E}\u{2A}\u{1DE}\u{B}\u{2A}\u{3}\u{2A}" .
		    "\u{5}\u{2A}\u{1E1}\u{A}\u{2A}\u{3}\u{2B}\u{3}\u{2B}\u{3}\u{2B}\u{5}" .
		    "\u{2B}\u{1E6}\u{A}\u{2B}\u{3}\u{2B}\u{3}\u{2B}\u{3}\u{2C}\u{3}\u{2C}" .
		    "\u{3}\u{2C}\u{7}\u{2C}\u{1ED}\u{A}\u{2C}\u{C}\u{2C}\u{E}\u{2C}\u{1F0}" .
		    "\u{B}\u{2C}\u{3}\u{2D}\u{3}\u{2D}\u{3}\u{2D}\u{5}\u{2D}\u{1F5}\u{A}" .
		    "\u{2D}\u{3}\u{2E}\u{3}\u{2E}\u{3}\u{2E}\u{3}\u{2E}\u{3}\u{2E}\u{3}" .
		    "\u{2E}\u{3}\u{2E}\u{3}\u{2E}\u{3}\u{2E}\u{3}\u{2E}\u{3}\u{2E}\u{5}" .
		    "\u{2E}\u{202}\u{A}\u{2E}\u{3}\u{2E}\u{2}\u{2}\u{2F}\u{2}\u{4}\u{6}" .
		    "\u{8}\u{A}\u{C}\u{E}\u{10}\u{12}\u{14}\u{16}\u{18}\u{1A}\u{1C}\u{1E}" .
		    "\u{20}\u{22}\u{24}\u{26}\u{28}\u{2A}\u{2C}\u{2E}\u{30}\u{32}\u{34}" .
		    "\u{36}\u{38}\u{3A}\u{3C}\u{3E}\u{40}\u{42}\u{44}\u{46}\u{48}\u{4A}" .
		    "\u{4C}\u{4E}\u{50}\u{52}\u{54}\u{56}\u{58}\u{5A}\u{2}\u{7}\u{4}\u{2}" .
		    "\u{3}\u{3}\u{B}\u{E}\u{3}\u{2}\u{15}\u{16}\u{3}\u{2}\u{17}\u{1A}\u{3}" .
		    "\u{2}\u{1B}\u{1C}\u{4}\u{2}\u{8}\u{8}\u{1D}\u{1E}\u{2}\u{22A}\u{2}" .
		    "\u{5F}\u{3}\u{2}\u{2}\u{2}\u{4}\u{68}\u{3}\u{2}\u{2}\u{2}\u{6}\u{74}" .
		    "\u{3}\u{2}\u{2}\u{2}\u{8}\u{76}\u{3}\u{2}\u{2}\u{2}\u{A}\u{7A}\u{3}" .
		    "\u{2}\u{2}\u{2}\u{C}\u{97}\u{3}\u{2}\u{2}\u{2}\u{E}\u{99}\u{3}\u{2}" .
		    "\u{2}\u{2}\u{10}\u{A6}\u{3}\u{2}\u{2}\u{2}\u{12}\u{A8}\u{3}\u{2}\u{2}" .
		    "\u{2}\u{14}\u{B0}\u{3}\u{2}\u{2}\u{2}\u{16}\u{B8}\u{3}\u{2}\u{2}\u{2}" .
		    "\u{18}\u{CB}\u{3}\u{2}\u{2}\u{2}\u{1A}\u{E2}\u{3}\u{2}\u{2}\u{2}\u{1C}" .
		    "\u{E4}\u{3}\u{2}\u{2}\u{2}\u{1E}\u{EA}\u{3}\u{2}\u{2}\u{2}\u{20}\u{EC}" .
		    "\u{3}\u{2}\u{2}\u{2}\u{22}\u{FD}\u{3}\u{2}\u{2}\u{2}\u{24}\u{10B}" .
		    "\u{3}\u{2}\u{2}\u{2}\u{26}\u{114}\u{3}\u{2}\u{2}\u{2}\u{28}\u{121}" .
		    "\u{3}\u{2}\u{2}\u{2}\u{2A}\u{123}\u{3}\u{2}\u{2}\u{2}\u{2C}\u{135}" .
		    "\u{3}\u{2}\u{2}\u{2}\u{2E}\u{137}\u{3}\u{2}\u{2}\u{2}\u{30}\u{144}" .
		    "\u{3}\u{2}\u{2}\u{2}\u{32}\u{149}\u{3}\u{2}\u{2}\u{2}\u{34}\u{14B}" .
		    "\u{3}\u{2}\u{2}\u{2}\u{36}\u{14D}\u{3}\u{2}\u{2}\u{2}\u{38}\u{14F}" .
		    "\u{3}\u{2}\u{2}\u{2}\u{3A}\u{153}\u{3}\u{2}\u{2}\u{2}\u{3C}\u{15C}" .
		    "\u{3}\u{2}\u{2}\u{2}\u{3E}\u{15E}\u{3}\u{2}\u{2}\u{2}\u{40}\u{160}" .
		    "\u{3}\u{2}\u{2}\u{2}\u{42}\u{168}\u{3}\u{2}\u{2}\u{2}\u{44}\u{170}" .
		    "\u{3}\u{2}\u{2}\u{2}\u{46}\u{178}\u{3}\u{2}\u{2}\u{2}\u{48}\u{180}" .
		    "\u{3}\u{2}\u{2}\u{2}\u{4A}\u{188}\u{3}\u{2}\u{2}\u{2}\u{4C}\u{199}" .
		    "\u{3}\u{2}\u{2}\u{2}\u{4E}\u{1BF}\u{3}\u{2}\u{2}\u{2}\u{50}\u{1D5}" .
		    "\u{3}\u{2}\u{2}\u{2}\u{52}\u{1D7}\u{3}\u{2}\u{2}\u{2}\u{54}\u{1E2}" .
		    "\u{3}\u{2}\u{2}\u{2}\u{56}\u{1E9}\u{3}\u{2}\u{2}\u{2}\u{58}\u{1F4}" .
		    "\u{3}\u{2}\u{2}\u{2}\u{5A}\u{201}\u{3}\u{2}\u{2}\u{2}\u{5C}\u{5E}" .
		    "\u{5}\u{4}\u{3}\u{2}\u{5D}\u{5C}\u{3}\u{2}\u{2}\u{2}\u{5E}\u{61}\u{3}" .
		    "\u{2}\u{2}\u{2}\u{5F}\u{5D}\u{3}\u{2}\u{2}\u{2}\u{5F}\u{60}\u{3}\u{2}" .
		    "\u{2}\u{2}\u{60}\u{62}\u{3}\u{2}\u{2}\u{2}\u{61}\u{5F}\u{3}\u{2}\u{2}" .
		    "\u{2}\u{62}\u{63}\u{7}\u{2}\u{2}\u{3}\u{63}\u{3}\u{3}\u{2}\u{2}\u{2}" .
		    "\u{64}\u{69}\u{5}\u{6}\u{4}\u{2}\u{65}\u{69}\u{5}\u{A}\u{6}\u{2}\u{66}" .
		    "\u{69}\u{5}\u{C}\u{7}\u{2}\u{67}\u{69}\u{5}\u{18}\u{D}\u{2}\u{68}" .
		    "\u{64}\u{3}\u{2}\u{2}\u{2}\u{68}\u{65}\u{3}\u{2}\u{2}\u{2}\u{68}\u{66}" .
		    "\u{3}\u{2}\u{2}\u{2}\u{68}\u{67}\u{3}\u{2}\u{2}\u{2}\u{69}\u{5}\u{3}" .
		    "\u{2}\u{2}\u{2}\u{6A}\u{6B}\u{7}\u{22}\u{2}\u{2}\u{6B}\u{6C}\u{5}" .
		    "\u{14}\u{B}\u{2}\u{6C}\u{6D}\u{5}\u{5A}\u{2E}\u{2}\u{6D}\u{75}\u{3}" .
		    "\u{2}\u{2}\u{2}\u{6E}\u{6F}\u{7}\u{22}\u{2}\u{2}\u{6F}\u{70}\u{5}" .
		    "\u{14}\u{B}\u{2}\u{70}\u{71}\u{5}\u{5A}\u{2E}\u{2}\u{71}\u{72}\u{7}" .
		    "\u{3}\u{2}\u{2}\u{72}\u{73}\u{5}\u{16}\u{C}\u{2}\u{73}\u{75}\u{3}" .
		    "\u{2}\u{2}\u{2}\u{74}\u{6A}\u{3}\u{2}\u{2}\u{2}\u{74}\u{6E}\u{3}\u{2}" .
		    "\u{2}\u{2}\u{75}\u{7}\u{3}\u{2}\u{2}\u{2}\u{76}\u{77}\u{5}\u{14}\u{B}" .
		    "\u{2}\u{77}\u{78}\u{7}\u{4}\u{2}\u{2}\u{78}\u{79}\u{5}\u{16}\u{C}" .
		    "\u{2}\u{79}\u{9}\u{3}\u{2}\u{2}\u{2}\u{7A}\u{7B}\u{7}\u{23}\u{2}\u{2}" .
		    "\u{7B}\u{7C}\u{7}\u{38}\u{2}\u{2}\u{7C}\u{7D}\u{5}\u{5A}\u{2E}\u{2}" .
		    "\u{7D}\u{7E}\u{7}\u{3}\u{2}\u{2}\u{7E}\u{7F}\u{5}\u{3E}\u{20}\u{2}" .
		    "\u{7F}\u{B}\u{3}\u{2}\u{2}\u{2}\u{80}\u{81}\u{7}\u{24}\u{2}\u{2}\u{81}" .
		    "\u{82}\u{7}\u{38}\u{2}\u{2}\u{82}\u{84}\u{7}\u{5}\u{2}\u{2}\u{83}" .
		    "\u{85}\u{5}\u{E}\u{8}\u{2}\u{84}\u{83}\u{3}\u{2}\u{2}\u{2}\u{84}\u{85}" .
		    "\u{3}\u{2}\u{2}\u{2}\u{85}\u{86}\u{3}\u{2}\u{2}\u{2}\u{86}\u{88}\u{7}" .
		    "\u{6}\u{2}\u{2}\u{87}\u{89}\u{5}\u{5A}\u{2E}\u{2}\u{88}\u{87}\u{3}" .
		    "\u{2}\u{2}\u{2}\u{88}\u{89}\u{3}\u{2}\u{2}\u{2}\u{89}\u{8A}\u{3}\u{2}" .
		    "\u{2}\u{2}\u{8A}\u{98}\u{5}\u{3A}\u{1E}\u{2}\u{8B}\u{8C}\u{7}\u{24}" .
		    "\u{2}\u{2}\u{8C}\u{8D}\u{7}\u{38}\u{2}\u{2}\u{8D}\u{8F}\u{7}\u{5}" .
		    "\u{2}\u{2}\u{8E}\u{90}\u{5}\u{E}\u{8}\u{2}\u{8F}\u{8E}\u{3}\u{2}\u{2}" .
		    "\u{2}\u{8F}\u{90}\u{3}\u{2}\u{2}\u{2}\u{90}\u{91}\u{3}\u{2}\u{2}\u{2}" .
		    "\u{91}\u{92}\u{7}\u{6}\u{2}\u{2}\u{92}\u{93}\u{7}\u{5}\u{2}\u{2}\u{93}" .
		    "\u{94}\u{5}\u{12}\u{A}\u{2}\u{94}\u{95}\u{7}\u{6}\u{2}\u{2}\u{95}" .
		    "\u{96}\u{5}\u{3A}\u{1E}\u{2}\u{96}\u{98}\u{3}\u{2}\u{2}\u{2}\u{97}" .
		    "\u{80}\u{3}\u{2}\u{2}\u{2}\u{97}\u{8B}\u{3}\u{2}\u{2}\u{2}\u{98}\u{D}" .
		    "\u{3}\u{2}\u{2}\u{2}\u{99}\u{9E}\u{5}\u{10}\u{9}\u{2}\u{9A}\u{9B}" .
		    "\u{7}\u{7}\u{2}\u{2}\u{9B}\u{9D}\u{5}\u{10}\u{9}\u{2}\u{9C}\u{9A}" .
		    "\u{3}\u{2}\u{2}\u{2}\u{9D}\u{A0}\u{3}\u{2}\u{2}\u{2}\u{9E}\u{9C}\u{3}" .
		    "\u{2}\u{2}\u{2}\u{9E}\u{9F}\u{3}\u{2}\u{2}\u{2}\u{9F}\u{F}\u{3}\u{2}" .
		    "\u{2}\u{2}\u{A0}\u{9E}\u{3}\u{2}\u{2}\u{2}\u{A1}\u{A2}\u{7}\u{38}" .
		    "\u{2}\u{2}\u{A2}\u{A7}\u{5}\u{5A}\u{2E}\u{2}\u{A3}\u{A4}\u{7}\u{8}" .
		    "\u{2}\u{2}\u{A4}\u{A5}\u{7}\u{38}\u{2}\u{2}\u{A5}\u{A7}\u{5}\u{5A}" .
		    "\u{2E}\u{2}\u{A6}\u{A1}\u{3}\u{2}\u{2}\u{2}\u{A6}\u{A3}\u{3}\u{2}" .
		    "\u{2}\u{2}\u{A7}\u{11}\u{3}\u{2}\u{2}\u{2}\u{A8}\u{AD}\u{5}\u{5A}" .
		    "\u{2E}\u{2}\u{A9}\u{AA}\u{7}\u{7}\u{2}\u{2}\u{AA}\u{AC}\u{5}\u{5A}" .
		    "\u{2E}\u{2}\u{AB}\u{A9}\u{3}\u{2}\u{2}\u{2}\u{AC}\u{AF}\u{3}\u{2}" .
		    "\u{2}\u{2}\u{AD}\u{AB}\u{3}\u{2}\u{2}\u{2}\u{AD}\u{AE}\u{3}\u{2}\u{2}" .
		    "\u{2}\u{AE}\u{13}\u{3}\u{2}\u{2}\u{2}\u{AF}\u{AD}\u{3}\u{2}\u{2}\u{2}" .
		    "\u{B0}\u{B5}\u{7}\u{38}\u{2}\u{2}\u{B1}\u{B2}\u{7}\u{7}\u{2}\u{2}" .
		    "\u{B2}\u{B4}\u{7}\u{38}\u{2}\u{2}\u{B3}\u{B1}\u{3}\u{2}\u{2}\u{2}" .
		    "\u{B4}\u{B7}\u{3}\u{2}\u{2}\u{2}\u{B5}\u{B3}\u{3}\u{2}\u{2}\u{2}\u{B5}" .
		    "\u{B6}\u{3}\u{2}\u{2}\u{2}\u{B6}\u{15}\u{3}\u{2}\u{2}\u{2}\u{B7}\u{B5}" .
		    "\u{3}\u{2}\u{2}\u{2}\u{B8}\u{BD}\u{5}\u{3E}\u{20}\u{2}\u{B9}\u{BA}" .
		    "\u{7}\u{7}\u{2}\u{2}\u{BA}\u{BC}\u{5}\u{3E}\u{20}\u{2}\u{BB}\u{B9}" .
		    "\u{3}\u{2}\u{2}\u{2}\u{BC}\u{BF}\u{3}\u{2}\u{2}\u{2}\u{BD}\u{BB}\u{3}" .
		    "\u{2}\u{2}\u{2}\u{BD}\u{BE}\u{3}\u{2}\u{2}\u{2}\u{BE}\u{17}\u{3}\u{2}" .
		    "\u{2}\u{2}\u{BF}\u{BD}\u{3}\u{2}\u{2}\u{2}\u{C0}\u{CC}\u{5}\u{8}\u{5}" .
		    "\u{2}\u{C1}\u{CC}\u{5}\u{1A}\u{E}\u{2}\u{C2}\u{CC}\u{5}\u{20}\u{11}" .
		    "\u{2}\u{C3}\u{CC}\u{5}\u{22}\u{12}\u{2}\u{C4}\u{CC}\u{5}\u{2C}\u{17}" .
		    "\u{2}\u{C5}\u{CC}\u{5}\u{34}\u{1B}\u{2}\u{C6}\u{CC}\u{5}\u{36}\u{1C}" .
		    "\u{2}\u{C7}\u{CC}\u{5}\u{38}\u{1D}\u{2}\u{C8}\u{CC}\u{5}\u{1E}\u{10}" .
		    "\u{2}\u{C9}\u{CC}\u{5}\u{3A}\u{1E}\u{2}\u{CA}\u{CC}\u{5}\u{3C}\u{1F}" .
		    "\u{2}\u{CB}\u{C0}\u{3}\u{2}\u{2}\u{2}\u{CB}\u{C1}\u{3}\u{2}\u{2}\u{2}" .
		    "\u{CB}\u{C2}\u{3}\u{2}\u{2}\u{2}\u{CB}\u{C3}\u{3}\u{2}\u{2}\u{2}\u{CB}" .
		    "\u{C4}\u{3}\u{2}\u{2}\u{2}\u{CB}\u{C5}\u{3}\u{2}\u{2}\u{2}\u{CB}\u{C6}" .
		    "\u{3}\u{2}\u{2}\u{2}\u{CB}\u{C7}\u{3}\u{2}\u{2}\u{2}\u{CB}\u{C8}\u{3}" .
		    "\u{2}\u{2}\u{2}\u{CB}\u{C9}\u{3}\u{2}\u{2}\u{2}\u{CB}\u{CA}\u{3}\u{2}" .
		    "\u{2}\u{2}\u{CC}\u{19}\u{3}\u{2}\u{2}\u{2}\u{CD}\u{CE}\u{7}\u{38}" .
		    "\u{2}\u{2}\u{CE}\u{CF}\u{5}\u{1C}\u{F}\u{2}\u{CF}\u{D0}\u{5}\u{3E}" .
		    "\u{20}\u{2}\u{D0}\u{E3}\u{3}\u{2}\u{2}\u{2}\u{D1}\u{D6}\u{7}\u{38}" .
		    "\u{2}\u{2}\u{D2}\u{D3}\u{7}\u{9}\u{2}\u{2}\u{D3}\u{D4}\u{5}\u{3E}" .
		    "\u{20}\u{2}\u{D4}\u{D5}\u{7}\u{A}\u{2}\u{2}\u{D5}\u{D7}\u{3}\u{2}" .
		    "\u{2}\u{2}\u{D6}\u{D2}\u{3}\u{2}\u{2}\u{2}\u{D7}\u{D8}\u{3}\u{2}\u{2}" .
		    "\u{2}\u{D8}\u{D6}\u{3}\u{2}\u{2}\u{2}\u{D8}\u{D9}\u{3}\u{2}\u{2}\u{2}" .
		    "\u{D9}\u{DA}\u{3}\u{2}\u{2}\u{2}\u{DA}\u{DB}\u{5}\u{1C}\u{F}\u{2}" .
		    "\u{DB}\u{DC}\u{5}\u{3E}\u{20}\u{2}\u{DC}\u{E3}\u{3}\u{2}\u{2}\u{2}" .
		    "\u{DD}\u{DE}\u{7}\u{8}\u{2}\u{2}\u{DE}\u{DF}\u{7}\u{38}\u{2}\u{2}" .
		    "\u{DF}\u{E0}\u{5}\u{1C}\u{F}\u{2}\u{E0}\u{E1}\u{5}\u{3E}\u{20}\u{2}" .
		    "\u{E1}\u{E3}\u{3}\u{2}\u{2}\u{2}\u{E2}\u{CD}\u{3}\u{2}\u{2}\u{2}\u{E2}" .
		    "\u{D1}\u{3}\u{2}\u{2}\u{2}\u{E2}\u{DD}\u{3}\u{2}\u{2}\u{2}\u{E3}\u{1B}" .
		    "\u{3}\u{2}\u{2}\u{2}\u{E4}\u{E5}\u{9}\u{2}\u{2}\u{2}\u{E5}\u{1D}\u{3}" .
		    "\u{2}\u{2}\u{2}\u{E6}\u{E7}\u{7}\u{38}\u{2}\u{2}\u{E7}\u{EB}\u{7}" .
		    "\u{F}\u{2}\u{2}\u{E8}\u{E9}\u{7}\u{38}\u{2}\u{2}\u{E9}\u{EB}\u{7}" .
		    "\u{10}\u{2}\u{2}\u{EA}\u{E6}\u{3}\u{2}\u{2}\u{2}\u{EA}\u{E8}\u{3}" .
		    "\u{2}\u{2}\u{2}\u{EB}\u{1F}\u{3}\u{2}\u{2}\u{2}\u{EC}\u{ED}\u{7}\u{25}" .
		    "\u{2}\u{2}\u{ED}\u{EE}\u{5}\u{3E}\u{20}\u{2}\u{EE}\u{F6}\u{5}\u{3A}" .
		    "\u{1E}\u{2}\u{EF}\u{F0}\u{7}\u{26}\u{2}\u{2}\u{F0}\u{F1}\u{7}\u{25}" .
		    "\u{2}\u{2}\u{F1}\u{F2}\u{5}\u{3E}\u{20}\u{2}\u{F2}\u{F3}\u{5}\u{3A}" .
		    "\u{1E}\u{2}\u{F3}\u{F5}\u{3}\u{2}\u{2}\u{2}\u{F4}\u{EF}\u{3}\u{2}" .
		    "\u{2}\u{2}\u{F5}\u{F8}\u{3}\u{2}\u{2}\u{2}\u{F6}\u{F4}\u{3}\u{2}\u{2}" .
		    "\u{2}\u{F6}\u{F7}\u{3}\u{2}\u{2}\u{2}\u{F7}\u{FB}\u{3}\u{2}\u{2}\u{2}" .
		    "\u{F8}\u{F6}\u{3}\u{2}\u{2}\u{2}\u{F9}\u{FA}\u{7}\u{26}\u{2}\u{2}" .
		    "\u{FA}\u{FC}\u{5}\u{3A}\u{1E}\u{2}\u{FB}\u{F9}\u{3}\u{2}\u{2}\u{2}" .
		    "\u{FB}\u{FC}\u{3}\u{2}\u{2}\u{2}\u{FC}\u{21}\u{3}\u{2}\u{2}\u{2}\u{FD}" .
		    "\u{FE}\u{7}\u{27}\u{2}\u{2}\u{FE}\u{FF}\u{5}\u{3E}\u{20}\u{2}\u{FF}" .
		    "\u{103}\u{7}\u{11}\u{2}\u{2}\u{100}\u{102}\u{5}\u{24}\u{13}\u{2}\u{101}" .
		    "\u{100}\u{3}\u{2}\u{2}\u{2}\u{102}\u{105}\u{3}\u{2}\u{2}\u{2}\u{103}" .
		    "\u{101}\u{3}\u{2}\u{2}\u{2}\u{103}\u{104}\u{3}\u{2}\u{2}\u{2}\u{104}" .
		    "\u{107}\u{3}\u{2}\u{2}\u{2}\u{105}\u{103}\u{3}\u{2}\u{2}\u{2}\u{106}" .
		    "\u{108}\u{5}\u{2A}\u{16}\u{2}\u{107}\u{106}\u{3}\u{2}\u{2}\u{2}\u{107}" .
		    "\u{108}\u{3}\u{2}\u{2}\u{2}\u{108}\u{109}\u{3}\u{2}\u{2}\u{2}\u{109}" .
		    "\u{10A}\u{7}\u{12}\u{2}\u{2}\u{10A}\u{23}\u{3}\u{2}\u{2}\u{2}\u{10B}" .
		    "\u{10C}\u{7}\u{28}\u{2}\u{2}\u{10C}\u{10D}\u{5}\u{26}\u{14}\u{2}\u{10D}" .
		    "\u{111}\u{7}\u{13}\u{2}\u{2}\u{10E}\u{110}\u{5}\u{18}\u{D}\u{2}\u{10F}" .
		    "\u{10E}\u{3}\u{2}\u{2}\u{2}\u{110}\u{113}\u{3}\u{2}\u{2}\u{2}\u{111}" .
		    "\u{10F}\u{3}\u{2}\u{2}\u{2}\u{111}\u{112}\u{3}\u{2}\u{2}\u{2}\u{112}" .
		    "\u{25}\u{3}\u{2}\u{2}\u{2}\u{113}\u{111}\u{3}\u{2}\u{2}\u{2}\u{114}" .
		    "\u{119}\u{5}\u{28}\u{15}\u{2}\u{115}\u{116}\u{7}\u{7}\u{2}\u{2}\u{116}" .
		    "\u{118}\u{5}\u{28}\u{15}\u{2}\u{117}\u{115}\u{3}\u{2}\u{2}\u{2}\u{118}" .
		    "\u{11B}\u{3}\u{2}\u{2}\u{2}\u{119}\u{117}\u{3}\u{2}\u{2}\u{2}\u{119}" .
		    "\u{11A}\u{3}\u{2}\u{2}\u{2}\u{11A}\u{27}\u{3}\u{2}\u{2}\u{2}\u{11B}" .
		    "\u{119}\u{3}\u{2}\u{2}\u{2}\u{11C}\u{11D}\u{5}\u{3E}\u{20}\u{2}\u{11D}" .
		    "\u{11E}\u{7}\u{33}\u{2}\u{2}\u{11E}\u{11F}\u{5}\u{3E}\u{20}\u{2}\u{11F}" .
		    "\u{122}\u{3}\u{2}\u{2}\u{2}\u{120}\u{122}\u{5}\u{3E}\u{20}\u{2}\u{121}" .
		    "\u{11C}\u{3}\u{2}\u{2}\u{2}\u{121}\u{120}\u{3}\u{2}\u{2}\u{2}\u{122}" .
		    "\u{29}\u{3}\u{2}\u{2}\u{2}\u{123}\u{124}\u{7}\u{29}\u{2}\u{2}\u{124}" .
		    "\u{128}\u{7}\u{13}\u{2}\u{2}\u{125}\u{127}\u{5}\u{18}\u{D}\u{2}\u{126}" .
		    "\u{125}\u{3}\u{2}\u{2}\u{2}\u{127}\u{12A}\u{3}\u{2}\u{2}\u{2}\u{128}" .
		    "\u{126}\u{3}\u{2}\u{2}\u{2}\u{128}\u{129}\u{3}\u{2}\u{2}\u{2}\u{129}" .
		    "\u{2B}\u{3}\u{2}\u{2}\u{2}\u{12A}\u{128}\u{3}\u{2}\u{2}\u{2}\u{12B}" .
		    "\u{12C}\u{7}\u{2A}\u{2}\u{2}\u{12C}\u{12D}\u{5}\u{2E}\u{18}\u{2}\u{12D}" .
		    "\u{12E}\u{5}\u{3A}\u{1E}\u{2}\u{12E}\u{136}\u{3}\u{2}\u{2}\u{2}\u{12F}" .
		    "\u{130}\u{7}\u{2A}\u{2}\u{2}\u{130}\u{131}\u{5}\u{3E}\u{20}\u{2}\u{131}" .
		    "\u{132}\u{5}\u{3A}\u{1E}\u{2}\u{132}\u{136}\u{3}\u{2}\u{2}\u{2}\u{133}" .
		    "\u{134}\u{7}\u{2A}\u{2}\u{2}\u{134}\u{136}\u{5}\u{3A}\u{1E}\u{2}\u{135}" .
		    "\u{12B}\u{3}\u{2}\u{2}\u{2}\u{135}\u{12F}\u{3}\u{2}\u{2}\u{2}\u{135}" .
		    "\u{133}\u{3}\u{2}\u{2}\u{2}\u{136}\u{2D}\u{3}\u{2}\u{2}\u{2}\u{137}" .
		    "\u{138}\u{5}\u{30}\u{19}\u{2}\u{138}\u{13A}\u{7}\u{14}\u{2}\u{2}\u{139}" .
		    "\u{13B}\u{5}\u{3E}\u{20}\u{2}\u{13A}\u{139}\u{3}\u{2}\u{2}\u{2}\u{13A}" .
		    "\u{13B}\u{3}\u{2}\u{2}\u{2}\u{13B}\u{13C}\u{3}\u{2}\u{2}\u{2}\u{13C}" .
		    "\u{13D}\u{7}\u{14}\u{2}\u{2}\u{13D}\u{13E}\u{5}\u{32}\u{1A}\u{2}\u{13E}" .
		    "\u{2F}\u{3}\u{2}\u{2}\u{2}\u{13F}\u{145}\u{5}\u{6}\u{4}\u{2}\u{140}" .
		    "\u{145}\u{5}\u{8}\u{5}\u{2}\u{141}\u{145}\u{5}\u{1A}\u{E}\u{2}\u{142}" .
		    "\u{145}\u{5}\u{1E}\u{10}\u{2}\u{143}\u{145}\u{3}\u{2}\u{2}\u{2}\u{144}" .
		    "\u{13F}\u{3}\u{2}\u{2}\u{2}\u{144}\u{140}\u{3}\u{2}\u{2}\u{2}\u{144}" .
		    "\u{141}\u{3}\u{2}\u{2}\u{2}\u{144}\u{142}\u{3}\u{2}\u{2}\u{2}\u{144}" .
		    "\u{143}\u{3}\u{2}\u{2}\u{2}\u{145}\u{31}\u{3}\u{2}\u{2}\u{2}\u{146}" .
		    "\u{14A}\u{5}\u{1A}\u{E}\u{2}\u{147}\u{14A}\u{5}\u{1E}\u{10}\u{2}\u{148}" .
		    "\u{14A}\u{3}\u{2}\u{2}\u{2}\u{149}\u{146}\u{3}\u{2}\u{2}\u{2}\u{149}" .
		    "\u{147}\u{3}\u{2}\u{2}\u{2}\u{149}\u{148}\u{3}\u{2}\u{2}\u{2}\u{14A}" .
		    "\u{33}\u{3}\u{2}\u{2}\u{2}\u{14B}\u{14C}\u{7}\u{2B}\u{2}\u{2}\u{14C}" .
		    "\u{35}\u{3}\u{2}\u{2}\u{2}\u{14D}\u{14E}\u{7}\u{2C}\u{2}\u{2}\u{14E}" .
		    "\u{37}\u{3}\u{2}\u{2}\u{2}\u{14F}\u{151}\u{7}\u{2D}\u{2}\u{2}\u{150}" .
		    "\u{152}\u{5}\u{16}\u{C}\u{2}\u{151}\u{150}\u{3}\u{2}\u{2}\u{2}\u{151}" .
		    "\u{152}\u{3}\u{2}\u{2}\u{2}\u{152}\u{39}\u{3}\u{2}\u{2}\u{2}\u{153}" .
		    "\u{157}\u{7}\u{11}\u{2}\u{2}\u{154}\u{156}\u{5}\u{4}\u{3}\u{2}\u{155}" .
		    "\u{154}\u{3}\u{2}\u{2}\u{2}\u{156}\u{159}\u{3}\u{2}\u{2}\u{2}\u{157}" .
		    "\u{155}\u{3}\u{2}\u{2}\u{2}\u{157}\u{158}\u{3}\u{2}\u{2}\u{2}\u{158}" .
		    "\u{15A}\u{3}\u{2}\u{2}\u{2}\u{159}\u{157}\u{3}\u{2}\u{2}\u{2}\u{15A}" .
		    "\u{15B}\u{7}\u{12}\u{2}\u{2}\u{15B}\u{3B}\u{3}\u{2}\u{2}\u{2}\u{15C}" .
		    "\u{15D}\u{5}\u{3E}\u{20}\u{2}\u{15D}\u{3D}\u{3}\u{2}\u{2}\u{2}\u{15E}" .
		    "\u{15F}\u{5}\u{40}\u{21}\u{2}\u{15F}\u{3F}\u{3}\u{2}\u{2}\u{2}\u{160}" .
		    "\u{165}\u{5}\u{42}\u{22}\u{2}\u{161}\u{162}\u{7}\u{32}\u{2}\u{2}\u{162}" .
		    "\u{164}\u{5}\u{42}\u{22}\u{2}\u{163}\u{161}\u{3}\u{2}\u{2}\u{2}\u{164}" .
		    "\u{167}\u{3}\u{2}\u{2}\u{2}\u{165}\u{163}\u{3}\u{2}\u{2}\u{2}\u{165}" .
		    "\u{166}\u{3}\u{2}\u{2}\u{2}\u{166}\u{41}\u{3}\u{2}\u{2}\u{2}\u{167}" .
		    "\u{165}\u{3}\u{2}\u{2}\u{2}\u{168}\u{16D}\u{5}\u{44}\u{23}\u{2}\u{169}" .
		    "\u{16A}\u{7}\u{31}\u{2}\u{2}\u{16A}\u{16C}\u{5}\u{44}\u{23}\u{2}\u{16B}" .
		    "\u{169}\u{3}\u{2}\u{2}\u{2}\u{16C}\u{16F}\u{3}\u{2}\u{2}\u{2}\u{16D}" .
		    "\u{16B}\u{3}\u{2}\u{2}\u{2}\u{16D}\u{16E}\u{3}\u{2}\u{2}\u{2}\u{16E}" .
		    "\u{43}\u{3}\u{2}\u{2}\u{2}\u{16F}\u{16D}\u{3}\u{2}\u{2}\u{2}\u{170}" .
		    "\u{175}\u{5}\u{46}\u{24}\u{2}\u{171}\u{172}\u{9}\u{3}\u{2}\u{2}\u{172}" .
		    "\u{174}\u{5}\u{46}\u{24}\u{2}\u{173}\u{171}\u{3}\u{2}\u{2}\u{2}\u{174}" .
		    "\u{177}\u{3}\u{2}\u{2}\u{2}\u{175}\u{173}\u{3}\u{2}\u{2}\u{2}\u{175}" .
		    "\u{176}\u{3}\u{2}\u{2}\u{2}\u{176}\u{45}\u{3}\u{2}\u{2}\u{2}\u{177}" .
		    "\u{175}\u{3}\u{2}\u{2}\u{2}\u{178}\u{17D}\u{5}\u{48}\u{25}\u{2}\u{179}" .
		    "\u{17A}\u{9}\u{4}\u{2}\u{2}\u{17A}\u{17C}\u{5}\u{48}\u{25}\u{2}\u{17B}" .
		    "\u{179}\u{3}\u{2}\u{2}\u{2}\u{17C}\u{17F}\u{3}\u{2}\u{2}\u{2}\u{17D}" .
		    "\u{17B}\u{3}\u{2}\u{2}\u{2}\u{17D}\u{17E}\u{3}\u{2}\u{2}\u{2}\u{17E}" .
		    "\u{47}\u{3}\u{2}\u{2}\u{2}\u{17F}\u{17D}\u{3}\u{2}\u{2}\u{2}\u{180}" .
		    "\u{185}\u{5}\u{4A}\u{26}\u{2}\u{181}\u{182}\u{9}\u{5}\u{2}\u{2}\u{182}" .
		    "\u{184}\u{5}\u{4A}\u{26}\u{2}\u{183}\u{181}\u{3}\u{2}\u{2}\u{2}\u{184}" .
		    "\u{187}\u{3}\u{2}\u{2}\u{2}\u{185}\u{183}\u{3}\u{2}\u{2}\u{2}\u{185}" .
		    "\u{186}\u{3}\u{2}\u{2}\u{2}\u{186}\u{49}\u{3}\u{2}\u{2}\u{2}\u{187}" .
		    "\u{185}\u{3}\u{2}\u{2}\u{2}\u{188}\u{18D}\u{5}\u{4C}\u{27}\u{2}\u{189}" .
		    "\u{18A}\u{9}\u{6}\u{2}\u{2}\u{18A}\u{18C}\u{5}\u{4C}\u{27}\u{2}\u{18B}" .
		    "\u{189}\u{3}\u{2}\u{2}\u{2}\u{18C}\u{18F}\u{3}\u{2}\u{2}\u{2}\u{18D}" .
		    "\u{18B}\u{3}\u{2}\u{2}\u{2}\u{18D}\u{18E}\u{3}\u{2}\u{2}\u{2}\u{18E}" .
		    "\u{4B}\u{3}\u{2}\u{2}\u{2}\u{18F}\u{18D}\u{3}\u{2}\u{2}\u{2}\u{190}" .
		    "\u{19A}\u{5}\u{4E}\u{28}\u{2}\u{191}\u{192}\u{7}\u{1C}\u{2}\u{2}\u{192}" .
		    "\u{19A}\u{5}\u{4C}\u{27}\u{2}\u{193}\u{194}\u{7}\u{1F}\u{2}\u{2}\u{194}" .
		    "\u{19A}\u{5}\u{4C}\u{27}\u{2}\u{195}\u{196}\u{7}\u{20}\u{2}\u{2}\u{196}" .
		    "\u{19A}\u{7}\u{38}\u{2}\u{2}\u{197}\u{198}\u{7}\u{8}\u{2}\u{2}\u{198}" .
		    "\u{19A}\u{5}\u{4C}\u{27}\u{2}\u{199}\u{190}\u{3}\u{2}\u{2}\u{2}\u{199}" .
		    "\u{191}\u{3}\u{2}\u{2}\u{2}\u{199}\u{193}\u{3}\u{2}\u{2}\u{2}\u{199}" .
		    "\u{195}\u{3}\u{2}\u{2}\u{2}\u{199}\u{197}\u{3}\u{2}\u{2}\u{2}\u{19A}" .
		    "\u{4D}\u{3}\u{2}\u{2}\u{2}\u{19B}\u{1C0}\u{7}\u{34}\u{2}\u{2}\u{19C}" .
		    "\u{1C0}\u{7}\u{35}\u{2}\u{2}\u{19D}\u{1C0}\u{7}\u{36}\u{2}\u{2}\u{19E}" .
		    "\u{1C0}\u{7}\u{37}\u{2}\u{2}\u{19F}\u{1C0}\u{7}\u{2E}\u{2}\u{2}\u{1A0}" .
		    "\u{1C0}\u{7}\u{2F}\u{2}\u{2}\u{1A1}\u{1C0}\u{7}\u{30}\u{2}\u{2}\u{1A2}" .
		    "\u{1A5}\u{7}\u{38}\u{2}\u{2}\u{1A3}\u{1A4}\u{7}\u{21}\u{2}\u{2}\u{1A4}" .
		    "\u{1A6}\u{7}\u{38}\u{2}\u{2}\u{1A5}\u{1A3}\u{3}\u{2}\u{2}\u{2}\u{1A5}" .
		    "\u{1A6}\u{3}\u{2}\u{2}\u{2}\u{1A6}\u{1A7}\u{3}\u{2}\u{2}\u{2}\u{1A7}" .
		    "\u{1A9}\u{7}\u{5}\u{2}\u{2}\u{1A8}\u{1AA}\u{5}\u{56}\u{2C}\u{2}\u{1A9}" .
		    "\u{1A8}\u{3}\u{2}\u{2}\u{2}\u{1A9}\u{1AA}\u{3}\u{2}\u{2}\u{2}\u{1AA}" .
		    "\u{1AB}\u{3}\u{2}\u{2}\u{2}\u{1AB}\u{1C0}\u{7}\u{6}\u{2}\u{2}\u{1AC}" .
		    "\u{1B1}\u{7}\u{38}\u{2}\u{2}\u{1AD}\u{1AE}\u{7}\u{9}\u{2}\u{2}\u{1AE}" .
		    "\u{1AF}\u{5}\u{3E}\u{20}\u{2}\u{1AF}\u{1B0}\u{7}\u{A}\u{2}\u{2}\u{1B0}" .
		    "\u{1B2}\u{3}\u{2}\u{2}\u{2}\u{1B1}\u{1AD}\u{3}\u{2}\u{2}\u{2}\u{1B2}" .
		    "\u{1B3}\u{3}\u{2}\u{2}\u{2}\u{1B3}\u{1B1}\u{3}\u{2}\u{2}\u{2}\u{1B3}" .
		    "\u{1B4}\u{3}\u{2}\u{2}\u{2}\u{1B4}\u{1C0}\u{3}\u{2}\u{2}\u{2}\u{1B5}" .
		    "\u{1C0}\u{7}\u{38}\u{2}\u{2}\u{1B6}\u{1B7}\u{7}\u{5}\u{2}\u{2}\u{1B7}" .
		    "\u{1B8}\u{5}\u{3E}\u{20}\u{2}\u{1B8}\u{1B9}\u{7}\u{6}\u{2}\u{2}\u{1B9}" .
		    "\u{1C0}\u{3}\u{2}\u{2}\u{2}\u{1BA}\u{1C0}\u{5}\u{50}\u{29}\u{2}\u{1BB}" .
		    "\u{1BC}\u{7}\u{11}\u{2}\u{2}\u{1BC}\u{1BD}\u{5}\u{16}\u{C}\u{2}\u{1BD}" .
		    "\u{1BE}\u{7}\u{12}\u{2}\u{2}\u{1BE}\u{1C0}\u{3}\u{2}\u{2}\u{2}\u{1BF}" .
		    "\u{19B}\u{3}\u{2}\u{2}\u{2}\u{1BF}\u{19C}\u{3}\u{2}\u{2}\u{2}\u{1BF}" .
		    "\u{19D}\u{3}\u{2}\u{2}\u{2}\u{1BF}\u{19E}\u{3}\u{2}\u{2}\u{2}\u{1BF}" .
		    "\u{19F}\u{3}\u{2}\u{2}\u{2}\u{1BF}\u{1A0}\u{3}\u{2}\u{2}\u{2}\u{1BF}" .
		    "\u{1A1}\u{3}\u{2}\u{2}\u{2}\u{1BF}\u{1A2}\u{3}\u{2}\u{2}\u{2}\u{1BF}" .
		    "\u{1AC}\u{3}\u{2}\u{2}\u{2}\u{1BF}\u{1B5}\u{3}\u{2}\u{2}\u{2}\u{1BF}" .
		    "\u{1B6}\u{3}\u{2}\u{2}\u{2}\u{1BF}\u{1BA}\u{3}\u{2}\u{2}\u{2}\u{1BF}" .
		    "\u{1BB}\u{3}\u{2}\u{2}\u{2}\u{1C0}\u{4F}\u{3}\u{2}\u{2}\u{2}\u{1C1}" .
		    "\u{1C2}\u{7}\u{9}\u{2}\u{2}\u{1C2}\u{1C3}\u{5}\u{3E}\u{20}\u{2}\u{1C3}" .
		    "\u{1C4}\u{7}\u{A}\u{2}\u{2}\u{1C4}\u{1C5}\u{5}\u{5A}\u{2E}\u{2}\u{1C5}" .
		    "\u{1C8}\u{7}\u{11}\u{2}\u{2}\u{1C6}\u{1C9}\u{5}\u{16}\u{C}\u{2}\u{1C7}" .
		    "\u{1C9}\u{5}\u{52}\u{2A}\u{2}\u{1C8}\u{1C6}\u{3}\u{2}\u{2}\u{2}\u{1C8}" .
		    "\u{1C7}\u{3}\u{2}\u{2}\u{2}\u{1C8}\u{1C9}\u{3}\u{2}\u{2}\u{2}\u{1C9}" .
		    "\u{1CA}\u{3}\u{2}\u{2}\u{2}\u{1CA}\u{1CB}\u{7}\u{12}\u{2}\u{2}\u{1CB}" .
		    "\u{1D6}\u{3}\u{2}\u{2}\u{2}\u{1CC}\u{1CD}\u{7}\u{9}\u{2}\u{2}\u{1CD}" .
		    "\u{1CE}\u{7}\u{A}\u{2}\u{2}\u{1CE}\u{1CF}\u{5}\u{5A}\u{2E}\u{2}\u{1CF}" .
		    "\u{1D1}\u{7}\u{11}\u{2}\u{2}\u{1D0}\u{1D2}\u{5}\u{16}\u{C}\u{2}\u{1D1}" .
		    "\u{1D0}\u{3}\u{2}\u{2}\u{2}\u{1D1}\u{1D2}\u{3}\u{2}\u{2}\u{2}\u{1D2}" .
		    "\u{1D3}\u{3}\u{2}\u{2}\u{2}\u{1D3}\u{1D4}\u{7}\u{12}\u{2}\u{2}\u{1D4}" .
		    "\u{1D6}\u{3}\u{2}\u{2}\u{2}\u{1D5}\u{1C1}\u{3}\u{2}\u{2}\u{2}\u{1D5}" .
		    "\u{1CC}\u{3}\u{2}\u{2}\u{2}\u{1D6}\u{51}\u{3}\u{2}\u{2}\u{2}\u{1D7}" .
		    "\u{1DC}\u{5}\u{54}\u{2B}\u{2}\u{1D8}\u{1D9}\u{7}\u{7}\u{2}\u{2}\u{1D9}" .
		    "\u{1DB}\u{5}\u{54}\u{2B}\u{2}\u{1DA}\u{1D8}\u{3}\u{2}\u{2}\u{2}\u{1DB}" .
		    "\u{1DE}\u{3}\u{2}\u{2}\u{2}\u{1DC}\u{1DA}\u{3}\u{2}\u{2}\u{2}\u{1DC}" .
		    "\u{1DD}\u{3}\u{2}\u{2}\u{2}\u{1DD}\u{1E0}\u{3}\u{2}\u{2}\u{2}\u{1DE}" .
		    "\u{1DC}\u{3}\u{2}\u{2}\u{2}\u{1DF}\u{1E1}\u{7}\u{7}\u{2}\u{2}\u{1E0}" .
		    "\u{1DF}\u{3}\u{2}\u{2}\u{2}\u{1E0}\u{1E1}\u{3}\u{2}\u{2}\u{2}\u{1E1}" .
		    "\u{53}\u{3}\u{2}\u{2}\u{2}\u{1E2}\u{1E3}\u{7}\u{11}\u{2}\u{2}\u{1E3}" .
		    "\u{1E5}\u{5}\u{16}\u{C}\u{2}\u{1E4}\u{1E6}\u{7}\u{7}\u{2}\u{2}\u{1E5}" .
		    "\u{1E4}\u{3}\u{2}\u{2}\u{2}\u{1E5}\u{1E6}\u{3}\u{2}\u{2}\u{2}\u{1E6}" .
		    "\u{1E7}\u{3}\u{2}\u{2}\u{2}\u{1E7}\u{1E8}\u{7}\u{12}\u{2}\u{2}\u{1E8}" .
		    "\u{55}\u{3}\u{2}\u{2}\u{2}\u{1E9}\u{1EE}\u{5}\u{58}\u{2D}\u{2}\u{1EA}" .
		    "\u{1EB}\u{7}\u{7}\u{2}\u{2}\u{1EB}\u{1ED}\u{5}\u{58}\u{2D}\u{2}\u{1EC}" .
		    "\u{1EA}\u{3}\u{2}\u{2}\u{2}\u{1ED}\u{1F0}\u{3}\u{2}\u{2}\u{2}\u{1EE}" .
		    "\u{1EC}\u{3}\u{2}\u{2}\u{2}\u{1EE}\u{1EF}\u{3}\u{2}\u{2}\u{2}\u{1EF}" .
		    "\u{57}\u{3}\u{2}\u{2}\u{2}\u{1F0}\u{1EE}\u{3}\u{2}\u{2}\u{2}\u{1F1}" .
		    "\u{1F5}\u{5}\u{3E}\u{20}\u{2}\u{1F2}\u{1F3}\u{7}\u{20}\u{2}\u{2}\u{1F3}" .
		    "\u{1F5}\u{7}\u{38}\u{2}\u{2}\u{1F4}\u{1F1}\u{3}\u{2}\u{2}\u{2}\u{1F4}" .
		    "\u{1F2}\u{3}\u{2}\u{2}\u{2}\u{1F5}\u{59}\u{3}\u{2}\u{2}\u{2}\u{1F6}" .
		    "\u{202}\u{7}\u{38}\u{2}\u{2}\u{1F7}\u{1F8}\u{7}\u{9}\u{2}\u{2}\u{1F8}" .
		    "\u{1F9}\u{5}\u{3E}\u{20}\u{2}\u{1F9}\u{1FA}\u{7}\u{A}\u{2}\u{2}\u{1FA}" .
		    "\u{1FB}\u{5}\u{5A}\u{2E}\u{2}\u{1FB}\u{202}\u{3}\u{2}\u{2}\u{2}\u{1FC}" .
		    "\u{1FD}\u{7}\u{9}\u{2}\u{2}\u{1FD}\u{1FE}\u{7}\u{A}\u{2}\u{2}\u{1FE}" .
		    "\u{202}\u{5}\u{5A}\u{2E}\u{2}\u{1FF}\u{200}\u{7}\u{8}\u{2}\u{2}\u{200}" .
		    "\u{202}\u{5}\u{5A}\u{2E}\u{2}\u{201}\u{1F6}\u{3}\u{2}\u{2}\u{2}\u{201}" .
		    "\u{1F7}\u{3}\u{2}\u{2}\u{2}\u{201}\u{1FC}\u{3}\u{2}\u{2}\u{2}\u{201}" .
		    "\u{1FF}\u{3}\u{2}\u{2}\u{2}\u{202}\u{5B}\u{3}\u{2}\u{2}\u{2}\u{34}" .
		    "\u{5F}\u{68}\u{74}\u{84}\u{88}\u{8F}\u{97}\u{9E}\u{A6}\u{AD}\u{B5}" .
		    "\u{BD}\u{CB}\u{D8}\u{E2}\u{EA}\u{F6}\u{FB}\u{103}\u{107}\u{111}\u{119}" .
		    "\u{121}\u{128}\u{135}\u{13A}\u{144}\u{149}\u{151}\u{157}\u{165}\u{16D}" .
		    "\u{175}\u{17D}\u{185}\u{18D}\u{199}\u{1A5}\u{1A9}\u{1B3}\u{1BF}\u{1C8}" .
		    "\u{1D1}\u{1D5}\u{1DC}\u{1E0}\u{1E5}\u{1EE}\u{1F4}\u{201}";

		protected static $atn;
		protected static $decisionToDFA;
		protected static $sharedContextCache;

		public function __construct(TokenStream $input)
		{
			parent::__construct($input);

			self::initialize();

			$this->interp = new ParserATNSimulator($this, self::$atn, self::$decisionToDFA, self::$sharedContextCache);
		}

		private static function initialize() : void
		{
			if (self::$atn !== null) {
				return;
			}

			RuntimeMetaData::checkVersion('4.9.2', RuntimeMetaData::VERSION);

			$atn = (new ATNDeserializer())->deserialize(self::SERIALIZED_ATN);

			$decisionToDFA = [];
			for ($i = 0, $count = $atn->getNumberOfDecisions(); $i < $count; $i++) {
				$decisionToDFA[] = new DFA($atn->getDecisionState($i), $i);
			}

			self::$atn = $atn;
			self::$decisionToDFA = $decisionToDFA;
			self::$sharedContextCache = new PredictionContextCache();
		}

		public function getGrammarFileName() : string
		{
			return "Golampi.g4";
		}

		public function getRuleNames() : array
		{
			return self::RULE_NAMES;
		}

		public function getSerializedATN() : string
		{
			return self::SERIALIZED_ATN;
		}

		public function getATN() : ATN
		{
			return self::$atn;
		}

		public function getVocabulary() : Vocabulary
        {
            static $vocabulary;

			return $vocabulary = $vocabulary ?? new VocabularyImpl(self::LITERAL_NAMES, self::SYMBOLIC_NAMES);
        }

		/**
		 * @throws RecognitionException
		 */
		public function program() : Context\ProgramContext
		{
		    $localContext = new Context\ProgramContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 0, self::RULE_program);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(93);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while (((($_la) & ~0x3f) === 0 && ((1 << $_la) & ((1 << self::T__2) | (1 << self::T__5) | (1 << self::T__6) | (1 << self::T__14) | (1 << self::T__25) | (1 << self::T__28) | (1 << self::T__29) | (1 << self::VAR) | (1 << self::CONST) | (1 << self::FUNC) | (1 << self::IF) | (1 << self::SWITCH) | (1 << self::FOR) | (1 << self::BREAK) | (1 << self::CONTINUE) | (1 << self::RETURN) | (1 << self::TRUE) | (1 << self::FALSE) | (1 << self::NIL) | (1 << self::INT32) | (1 << self::FLOAT32) | (1 << self::RUNE) | (1 << self::STRING) | (1 << self::ID))) !== 0)) {
		        	$this->setState(90);
		        	$this->declaration();
		        	$this->setState(95);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		        $this->setState(96);
		        $this->match(self::EOF);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function declaration() : Context\DeclarationContext
		{
		    $localContext = new Context\DeclarationContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 2, self::RULE_declaration);

		    try {
		        $this->setState(102);
		        $this->errorHandler->sync($this);

		        switch ($this->input->LA(1)) {
		            case self::VAR:
		            	$this->enterOuterAlt($localContext, 1);
		            	$this->setState(98);
		            	$this->varDeclaration();
		            	break;

		            case self::CONST:
		            	$this->enterOuterAlt($localContext, 2);
		            	$this->setState(99);
		            	$this->constDeclaration();
		            	break;

		            case self::FUNC:
		            	$this->enterOuterAlt($localContext, 3);
		            	$this->setState(100);
		            	$this->functionDeclaration();
		            	break;

		            case self::T__2:
		            case self::T__5:
		            case self::T__6:
		            case self::T__14:
		            case self::T__25:
		            case self::T__28:
		            case self::T__29:
		            case self::IF:
		            case self::SWITCH:
		            case self::FOR:
		            case self::BREAK:
		            case self::CONTINUE:
		            case self::RETURN:
		            case self::TRUE:
		            case self::FALSE:
		            case self::NIL:
		            case self::INT32:
		            case self::FLOAT32:
		            case self::RUNE:
		            case self::STRING:
		            case self::ID:
		            	$this->enterOuterAlt($localContext, 4);
		            	$this->setState(101);
		            	$this->statement();
		            	break;

		        default:
		        	throw new NoViableAltException($this);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function varDeclaration() : Context\VarDeclarationContext
		{
		    $localContext = new Context\VarDeclarationContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 4, self::RULE_varDeclaration);

		    try {
		        $this->setState(114);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 2, $this->ctx)) {
		        	case 1:
		        	    $localContext = new Context\VarDeclSimpleContext($localContext);
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(104);
		        	    $this->match(self::VAR);
		        	    $this->setState(105);
		        	    $this->idList();
		        	    $this->setState(106);
		        	    $this->type();
		        	break;

		        	case 2:
		        	    $localContext = new Context\VarDeclWithInitContext($localContext);
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(108);
		        	    $this->match(self::VAR);
		        	    $this->setState(109);
		        	    $this->idList();
		        	    $this->setState(110);
		        	    $this->type();
		        	    $this->setState(111);
		        	    $this->match(self::T__0);
		        	    $this->setState(112);
		        	    $this->expressionList();
		        	break;
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function shortVarDeclaration() : Context\ShortVarDeclarationContext
		{
		    $localContext = new Context\ShortVarDeclarationContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 6, self::RULE_shortVarDeclaration);

		    try {
		        $localContext = new Context\ShortVarDeclContext($localContext);
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(116);
		        $this->idList();
		        $this->setState(117);
		        $this->match(self::T__1);
		        $this->setState(118);
		        $this->expressionList();
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function constDeclaration() : Context\ConstDeclarationContext
		{
		    $localContext = new Context\ConstDeclarationContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 8, self::RULE_constDeclaration);

		    try {
		        $localContext = new Context\ConstDeclContext($localContext);
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(120);
		        $this->match(self::CONST);
		        $this->setState(121);
		        $this->match(self::ID);
		        $this->setState(122);
		        $this->type();
		        $this->setState(123);
		        $this->match(self::T__0);
		        $this->setState(124);
		        $this->expression();
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function functionDeclaration() : Context\FunctionDeclarationContext
		{
		    $localContext = new Context\FunctionDeclarationContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 10, self::RULE_functionDeclaration);

		    try {
		        $this->setState(149);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 6, $this->ctx)) {
		        	case 1:
		        	    $localContext = new Context\FuncDeclSingleReturnContext($localContext);
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(126);
		        	    $this->match(self::FUNC);
		        	    $this->setState(127);
		        	    $this->match(self::ID);
		        	    $this->setState(128);
		        	    $this->match(self::T__2);
		        	    $this->setState(130);
		        	    $this->errorHandler->sync($this);
		        	    $_la = $this->input->LA(1);

		        	    if ($_la === self::T__5 || $_la === self::ID) {
		        	    	$this->setState(129);
		        	    	$this->parameterList();
		        	    }
		        	    $this->setState(132);
		        	    $this->match(self::T__3);
		        	    $this->setState(134);
		        	    $this->errorHandler->sync($this);
		        	    $_la = $this->input->LA(1);

		        	    if (((($_la) & ~0x3f) === 0 && ((1 << $_la) & ((1 << self::T__5) | (1 << self::T__6) | (1 << self::ID))) !== 0)) {
		        	    	$this->setState(133);
		        	    	$this->type();
		        	    }
		        	    $this->setState(136);
		        	    $this->block();
		        	break;

		        	case 2:
		        	    $localContext = new Context\FuncDeclMultiReturnContext($localContext);
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(137);
		        	    $this->match(self::FUNC);
		        	    $this->setState(138);
		        	    $this->match(self::ID);
		        	    $this->setState(139);
		        	    $this->match(self::T__2);
		        	    $this->setState(141);
		        	    $this->errorHandler->sync($this);
		        	    $_la = $this->input->LA(1);

		        	    if ($_la === self::T__5 || $_la === self::ID) {
		        	    	$this->setState(140);
		        	    	$this->parameterList();
		        	    }
		        	    $this->setState(143);
		        	    $this->match(self::T__3);
		        	    $this->setState(144);
		        	    $this->match(self::T__2);
		        	    $this->setState(145);
		        	    $this->typeList();
		        	    $this->setState(146);
		        	    $this->match(self::T__3);
		        	    $this->setState(147);
		        	    $this->block();
		        	break;
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function parameterList() : Context\ParameterListContext
		{
		    $localContext = new Context\ParameterListContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 12, self::RULE_parameterList);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(151);
		        $this->parameter();
		        $this->setState(156);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::T__4) {
		        	$this->setState(152);
		        	$this->match(self::T__4);
		        	$this->setState(153);
		        	$this->parameter();
		        	$this->setState(158);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function parameter() : Context\ParameterContext
		{
		    $localContext = new Context\ParameterContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 14, self::RULE_parameter);

		    try {
		        $this->setState(164);
		        $this->errorHandler->sync($this);

		        switch ($this->input->LA(1)) {
		            case self::ID:
		            	$localContext = new Context\NormalParameterContext($localContext);
		            	$this->enterOuterAlt($localContext, 1);
		            	$this->setState(159);
		            	$this->match(self::ID);
		            	$this->setState(160);
		            	$this->type();
		            	break;

		            case self::T__5:
		            	$localContext = new Context\PointerParameterContext($localContext);
		            	$this->enterOuterAlt($localContext, 2);
		            	$this->setState(161);
		            	$this->match(self::T__5);
		            	$this->setState(162);
		            	$this->match(self::ID);
		            	$this->setState(163);
		            	$this->type();
		            	break;

		        default:
		        	throw new NoViableAltException($this);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function typeList() : Context\TypeListContext
		{
		    $localContext = new Context\TypeListContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 16, self::RULE_typeList);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(166);
		        $this->type();
		        $this->setState(171);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::T__4) {
		        	$this->setState(167);
		        	$this->match(self::T__4);
		        	$this->setState(168);
		        	$this->type();
		        	$this->setState(173);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function idList() : Context\IdListContext
		{
		    $localContext = new Context\IdListContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 18, self::RULE_idList);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(174);
		        $this->match(self::ID);
		        $this->setState(179);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::T__4) {
		        	$this->setState(175);
		        	$this->match(self::T__4);
		        	$this->setState(176);
		        	$this->match(self::ID);
		        	$this->setState(181);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function expressionList() : Context\ExpressionListContext
		{
		    $localContext = new Context\ExpressionListContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 20, self::RULE_expressionList);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(182);
		        $this->expression();
		        $this->setState(187);
		        $this->errorHandler->sync($this);

		        $alt = $this->getInterpreter()->adaptivePredict($this->input, 11, $this->ctx);

		        while ($alt !== 2 && $alt !== ATN::INVALID_ALT_NUMBER) {
		        	if ($alt === 1) {
		        		$this->setState(183);
		        		$this->match(self::T__4);
		        		$this->setState(184);
		        		$this->expression(); 
		        	}

		        	$this->setState(189);
		        	$this->errorHandler->sync($this);

		        	$alt = $this->getInterpreter()->adaptivePredict($this->input, 11, $this->ctx);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function statement() : Context\StatementContext
		{
		    $localContext = new Context\StatementContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 22, self::RULE_statement);

		    try {
		        $this->setState(201);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 12, $this->ctx)) {
		        	case 1:
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(190);
		        	    $this->shortVarDeclaration();
		        	break;

		        	case 2:
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(191);
		        	    $this->assignment();
		        	break;

		        	case 3:
		        	    $this->enterOuterAlt($localContext, 3);
		        	    $this->setState(192);
		        	    $this->ifStatement();
		        	break;

		        	case 4:
		        	    $this->enterOuterAlt($localContext, 4);
		        	    $this->setState(193);
		        	    $this->switchStatement();
		        	break;

		        	case 5:
		        	    $this->enterOuterAlt($localContext, 5);
		        	    $this->setState(194);
		        	    $this->forStatement();
		        	break;

		        	case 6:
		        	    $this->enterOuterAlt($localContext, 6);
		        	    $this->setState(195);
		        	    $this->breakStatement();
		        	break;

		        	case 7:
		        	    $this->enterOuterAlt($localContext, 7);
		        	    $this->setState(196);
		        	    $this->continueStatement();
		        	break;

		        	case 8:
		        	    $this->enterOuterAlt($localContext, 8);
		        	    $this->setState(197);
		        	    $this->returnStatement();
		        	break;

		        	case 9:
		        	    $this->enterOuterAlt($localContext, 9);
		        	    $this->setState(198);
		        	    $this->incDecStatement();
		        	break;

		        	case 10:
		        	    $this->enterOuterAlt($localContext, 10);
		        	    $this->setState(199);
		        	    $this->block();
		        	break;

		        	case 11:
		        	    $this->enterOuterAlt($localContext, 11);
		        	    $this->setState(200);
		        	    $this->expressionStatement();
		        	break;
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function assignment() : Context\AssignmentContext
		{
		    $localContext = new Context\AssignmentContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 24, self::RULE_assignment);

		    try {
		        $this->setState(224);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 14, $this->ctx)) {
		        	case 1:
		        	    $localContext = new Context\SimpleAssignmentContext($localContext);
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(203);
		        	    $this->match(self::ID);
		        	    $this->setState(204);
		        	    $this->assignOp();
		        	    $this->setState(205);
		        	    $this->expression();
		        	break;

		        	case 2:
		        	    $localContext = new Context\ArrayAssignmentContext($localContext);
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(207);
		        	    $this->match(self::ID);
		        	    $this->setState(212); 
		        	    $this->errorHandler->sync($this);

		        	    $_la = $this->input->LA(1);
		        	    do {
		        	    	$this->setState(208);
		        	    	$this->match(self::T__6);
		        	    	$this->setState(209);
		        	    	$this->expression();
		        	    	$this->setState(210);
		        	    	$this->match(self::T__7);
		        	    	$this->setState(214); 
		        	    	$this->errorHandler->sync($this);
		        	    	$_la = $this->input->LA(1);
		        	    } while ($_la === self::T__6);
		        	    $this->setState(216);
		        	    $this->assignOp();
		        	    $this->setState(217);
		        	    $this->expression();
		        	break;

		        	case 3:
		        	    $localContext = new Context\PointerAssignmentContext($localContext);
		        	    $this->enterOuterAlt($localContext, 3);
		        	    $this->setState(219);
		        	    $this->match(self::T__5);
		        	    $this->setState(220);
		        	    $this->match(self::ID);
		        	    $this->setState(221);
		        	    $this->assignOp();
		        	    $this->setState(222);
		        	    $this->expression();
		        	break;
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function assignOp() : Context\AssignOpContext
		{
		    $localContext = new Context\AssignOpContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 26, self::RULE_assignOp);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(226);

		        $_la = $this->input->LA(1);

		        if (!(((($_la) & ~0x3f) === 0 && ((1 << $_la) & ((1 << self::T__0) | (1 << self::T__8) | (1 << self::T__9) | (1 << self::T__10) | (1 << self::T__11))) !== 0))) {
		        $this->errorHandler->recoverInline($this);
		        } else {
		        	if ($this->input->LA(1) === Token::EOF) {
		        	    $this->matchedEOF = true;
		            }

		        	$this->errorHandler->reportMatch($this);
		        	$this->consume();
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function incDecStatement() : Context\IncDecStatementContext
		{
		    $localContext = new Context\IncDecStatementContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 28, self::RULE_incDecStatement);

		    try {
		        $this->setState(232);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 15, $this->ctx)) {
		        	case 1:
		        	    $localContext = new Context\IncrementStatementContext($localContext);
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(228);
		        	    $this->match(self::ID);
		        	    $this->setState(229);
		        	    $this->match(self::T__12);
		        	break;

		        	case 2:
		        	    $localContext = new Context\DecrementStatementContext($localContext);
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(230);
		        	    $this->match(self::ID);
		        	    $this->setState(231);
		        	    $this->match(self::T__13);
		        	break;
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function ifStatement() : Context\IfStatementContext
		{
		    $localContext = new Context\IfStatementContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 30, self::RULE_ifStatement);

		    try {
		        $localContext = new Context\IfElseIfElseContext($localContext);
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(234);
		        $this->match(self::IF);
		        $this->setState(235);
		        $this->expression();
		        $this->setState(236);
		        $this->block();
		        $this->setState(244);
		        $this->errorHandler->sync($this);

		        $alt = $this->getInterpreter()->adaptivePredict($this->input, 16, $this->ctx);

		        while ($alt !== 2 && $alt !== ATN::INVALID_ALT_NUMBER) {
		        	if ($alt === 1) {
		        		$this->setState(237);
		        		$this->match(self::ELSE);
		        		$this->setState(238);
		        		$this->match(self::IF);
		        		$this->setState(239);
		        		$this->expression();
		        		$this->setState(240);
		        		$this->block(); 
		        	}

		        	$this->setState(246);
		        	$this->errorHandler->sync($this);

		        	$alt = $this->getInterpreter()->adaptivePredict($this->input, 16, $this->ctx);
		        }
		        $this->setState(249);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ($_la === self::ELSE) {
		        	$this->setState(247);
		        	$this->match(self::ELSE);
		        	$this->setState(248);
		        	$this->block();
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function switchStatement() : Context\SwitchStatementContext
		{
		    $localContext = new Context\SwitchStatementContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 32, self::RULE_switchStatement);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(251);
		        $this->match(self::SWITCH);
		        $this->setState(252);
		        $this->expression();
		        $this->setState(253);
		        $this->match(self::T__14);
		        $this->setState(257);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::CASE) {
		        	$this->setState(254);
		        	$this->caseClause();
		        	$this->setState(259);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		        $this->setState(261);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ($_la === self::DEFAULT) {
		        	$this->setState(260);
		        	$this->defaultClause();
		        }
		        $this->setState(263);
		        $this->match(self::T__15);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function caseClause() : Context\CaseClauseContext
		{
		    $localContext = new Context\CaseClauseContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 34, self::RULE_caseClause);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(265);
		        $this->match(self::CASE);
		        $this->setState(266);
		        $this->caseExpressionList();
		        $this->setState(267);
		        $this->match(self::T__16);
		        $this->setState(271);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while (((($_la) & ~0x3f) === 0 && ((1 << $_la) & ((1 << self::T__2) | (1 << self::T__5) | (1 << self::T__6) | (1 << self::T__14) | (1 << self::T__25) | (1 << self::T__28) | (1 << self::T__29) | (1 << self::IF) | (1 << self::SWITCH) | (1 << self::FOR) | (1 << self::BREAK) | (1 << self::CONTINUE) | (1 << self::RETURN) | (1 << self::TRUE) | (1 << self::FALSE) | (1 << self::NIL) | (1 << self::INT32) | (1 << self::FLOAT32) | (1 << self::RUNE) | (1 << self::STRING) | (1 << self::ID))) !== 0)) {
		        	$this->setState(268);
		        	$this->statement();
		        	$this->setState(273);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function caseExpressionList() : Context\CaseExpressionListContext
		{
		    $localContext = new Context\CaseExpressionListContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 36, self::RULE_caseExpressionList);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(274);
		        $this->caseExpression();
		        $this->setState(279);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::T__4) {
		        	$this->setState(275);
		        	$this->match(self::T__4);
		        	$this->setState(276);
		        	$this->caseExpression();
		        	$this->setState(281);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function caseExpression() : Context\CaseExpressionContext
		{
		    $localContext = new Context\CaseExpressionContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 38, self::RULE_caseExpression);

		    try {
		        $this->setState(287);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 22, $this->ctx)) {
		        	case 1:
		        	    $localContext = new Context\RangeCaseExprContext($localContext);
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(282);
		        	    $this->expression();
		        	    $this->setState(283);
		        	    $this->match(self::RANGE);
		        	    $this->setState(284);
		        	    $this->expression();
		        	break;

		        	case 2:
		        	    $localContext = new Context\SingleCaseExprContext($localContext);
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(286);
		        	    $this->expression();
		        	break;
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function defaultClause() : Context\DefaultClauseContext
		{
		    $localContext = new Context\DefaultClauseContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 40, self::RULE_defaultClause);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(289);
		        $this->match(self::DEFAULT);
		        $this->setState(290);
		        $this->match(self::T__16);
		        $this->setState(294);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while (((($_la) & ~0x3f) === 0 && ((1 << $_la) & ((1 << self::T__2) | (1 << self::T__5) | (1 << self::T__6) | (1 << self::T__14) | (1 << self::T__25) | (1 << self::T__28) | (1 << self::T__29) | (1 << self::IF) | (1 << self::SWITCH) | (1 << self::FOR) | (1 << self::BREAK) | (1 << self::CONTINUE) | (1 << self::RETURN) | (1 << self::TRUE) | (1 << self::FALSE) | (1 << self::NIL) | (1 << self::INT32) | (1 << self::FLOAT32) | (1 << self::RUNE) | (1 << self::STRING) | (1 << self::ID))) !== 0)) {
		        	$this->setState(291);
		        	$this->statement();
		        	$this->setState(296);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function forStatement() : Context\ForStatementContext
		{
		    $localContext = new Context\ForStatementContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 42, self::RULE_forStatement);

		    try {
		        $this->setState(307);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 24, $this->ctx)) {
		        	case 1:
		        	    $localContext = new Context\ForTraditionalContext($localContext);
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(297);
		        	    $this->match(self::FOR);
		        	    $this->setState(298);
		        	    $this->forClause();
		        	    $this->setState(299);
		        	    $this->block();
		        	break;

		        	case 2:
		        	    $localContext = new Context\ForWhileContext($localContext);
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(301);
		        	    $this->match(self::FOR);
		        	    $this->setState(302);
		        	    $this->expression();
		        	    $this->setState(303);
		        	    $this->block();
		        	break;

		        	case 3:
		        	    $localContext = new Context\ForInfiniteContext($localContext);
		        	    $this->enterOuterAlt($localContext, 3);
		        	    $this->setState(305);
		        	    $this->match(self::FOR);
		        	    $this->setState(306);
		        	    $this->block();
		        	break;
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function forClause() : Context\ForClauseContext
		{
		    $localContext = new Context\ForClauseContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 44, self::RULE_forClause);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(309);
		        $this->forInit();
		        $this->setState(310);
		        $this->match(self::T__17);
		        $this->setState(312);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if (((($_la) & ~0x3f) === 0 && ((1 << $_la) & ((1 << self::T__2) | (1 << self::T__5) | (1 << self::T__6) | (1 << self::T__14) | (1 << self::T__25) | (1 << self::T__28) | (1 << self::T__29) | (1 << self::TRUE) | (1 << self::FALSE) | (1 << self::NIL) | (1 << self::INT32) | (1 << self::FLOAT32) | (1 << self::RUNE) | (1 << self::STRING) | (1 << self::ID))) !== 0)) {
		        	$this->setState(311);
		        	$this->expression();
		        }
		        $this->setState(314);
		        $this->match(self::T__17);
		        $this->setState(315);
		        $this->forPost();
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function forInit() : Context\ForInitContext
		{
		    $localContext = new Context\ForInitContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 46, self::RULE_forInit);

		    try {
		        $this->setState(322);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 26, $this->ctx)) {
		        	case 1:
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(317);
		        	    $this->varDeclaration();
		        	break;

		        	case 2:
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(318);
		        	    $this->shortVarDeclaration();
		        	break;

		        	case 3:
		        	    $this->enterOuterAlt($localContext, 3);
		        	    $this->setState(319);
		        	    $this->assignment();
		        	break;

		        	case 4:
		        	    $this->enterOuterAlt($localContext, 4);
		        	    $this->setState(320);
		        	    $this->incDecStatement();
		        	break;

		        	case 5:
		        	    $this->enterOuterAlt($localContext, 5);

		        	break;
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function forPost() : Context\ForPostContext
		{
		    $localContext = new Context\ForPostContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 48, self::RULE_forPost);

		    try {
		        $this->setState(327);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 27, $this->ctx)) {
		        	case 1:
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(324);
		        	    $this->assignment();
		        	break;

		        	case 2:
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(325);
		        	    $this->incDecStatement();
		        	break;

		        	case 3:
		        	    $this->enterOuterAlt($localContext, 3);

		        	break;
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function breakStatement() : Context\BreakStatementContext
		{
		    $localContext = new Context\BreakStatementContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 50, self::RULE_breakStatement);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(329);
		        $this->match(self::BREAK);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function continueStatement() : Context\ContinueStatementContext
		{
		    $localContext = new Context\ContinueStatementContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 52, self::RULE_continueStatement);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(331);
		        $this->match(self::CONTINUE);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function returnStatement() : Context\ReturnStatementContext
		{
		    $localContext = new Context\ReturnStatementContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 54, self::RULE_returnStatement);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(333);
		        $this->match(self::RETURN);
		        $this->setState(335);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 28, $this->ctx)) {
		            case 1:
		        	    $this->setState(334);
		        	    $this->expressionList();
		        	break;
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function block() : Context\BlockContext
		{
		    $localContext = new Context\BlockContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 56, self::RULE_block);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(337);
		        $this->match(self::T__14);
		        $this->setState(341);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while (((($_la) & ~0x3f) === 0 && ((1 << $_la) & ((1 << self::T__2) | (1 << self::T__5) | (1 << self::T__6) | (1 << self::T__14) | (1 << self::T__25) | (1 << self::T__28) | (1 << self::T__29) | (1 << self::VAR) | (1 << self::CONST) | (1 << self::FUNC) | (1 << self::IF) | (1 << self::SWITCH) | (1 << self::FOR) | (1 << self::BREAK) | (1 << self::CONTINUE) | (1 << self::RETURN) | (1 << self::TRUE) | (1 << self::FALSE) | (1 << self::NIL) | (1 << self::INT32) | (1 << self::FLOAT32) | (1 << self::RUNE) | (1 << self::STRING) | (1 << self::ID))) !== 0)) {
		        	$this->setState(338);
		        	$this->declaration();
		        	$this->setState(343);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		        $this->setState(344);
		        $this->match(self::T__15);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function expressionStatement() : Context\ExpressionStatementContext
		{
		    $localContext = new Context\ExpressionStatementContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 58, self::RULE_expressionStatement);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(346);
		        $this->expression();
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function expression() : Context\ExpressionContext
		{
		    $localContext = new Context\ExpressionContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 60, self::RULE_expression);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(348);
		        $this->logicalOr();
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function logicalOr() : Context\LogicalOrContext
		{
		    $localContext = new Context\LogicalOrContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 62, self::RULE_logicalOr);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(350);
		        $this->logicalAnd();
		        $this->setState(355);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::OR) {
		        	$this->setState(351);
		        	$this->match(self::OR);
		        	$this->setState(352);
		        	$this->logicalAnd();
		        	$this->setState(357);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function logicalAnd() : Context\LogicalAndContext
		{
		    $localContext = new Context\LogicalAndContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 64, self::RULE_logicalAnd);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(358);
		        $this->equality();
		        $this->setState(363);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::AND) {
		        	$this->setState(359);
		        	$this->match(self::AND);
		        	$this->setState(360);
		        	$this->equality();
		        	$this->setState(365);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function equality() : Context\EqualityContext
		{
		    $localContext = new Context\EqualityContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 66, self::RULE_equality);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(366);
		        $this->relational();
		        $this->setState(371);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::T__18 || $_la === self::T__19) {
		        	$this->setState(367);

		        	$_la = $this->input->LA(1);

		        	if (!($_la === self::T__18 || $_la === self::T__19)) {
		        	$this->errorHandler->recoverInline($this);
		        	} else {
		        		if ($this->input->LA(1) === Token::EOF) {
		        		    $this->matchedEOF = true;
		        	    }

		        		$this->errorHandler->reportMatch($this);
		        		$this->consume();
		        	}
		        	$this->setState(368);
		        	$this->relational();
		        	$this->setState(373);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function relational() : Context\RelationalContext
		{
		    $localContext = new Context\RelationalContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 68, self::RULE_relational);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(374);
		        $this->additive();
		        $this->setState(379);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while (((($_la) & ~0x3f) === 0 && ((1 << $_la) & ((1 << self::T__20) | (1 << self::T__21) | (1 << self::T__22) | (1 << self::T__23))) !== 0)) {
		        	$this->setState(375);

		        	$_la = $this->input->LA(1);

		        	if (!(((($_la) & ~0x3f) === 0 && ((1 << $_la) & ((1 << self::T__20) | (1 << self::T__21) | (1 << self::T__22) | (1 << self::T__23))) !== 0))) {
		        	$this->errorHandler->recoverInline($this);
		        	} else {
		        		if ($this->input->LA(1) === Token::EOF) {
		        		    $this->matchedEOF = true;
		        	    }

		        		$this->errorHandler->reportMatch($this);
		        		$this->consume();
		        	}
		        	$this->setState(376);
		        	$this->additive();
		        	$this->setState(381);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function additive() : Context\AdditiveContext
		{
		    $localContext = new Context\AdditiveContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 70, self::RULE_additive);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(382);
		        $this->multiplicative();
		        $this->setState(387);
		        $this->errorHandler->sync($this);

		        $alt = $this->getInterpreter()->adaptivePredict($this->input, 34, $this->ctx);

		        while ($alt !== 2 && $alt !== ATN::INVALID_ALT_NUMBER) {
		        	if ($alt === 1) {
		        		$this->setState(383);

		        		$_la = $this->input->LA(1);

		        		if (!($_la === self::T__24 || $_la === self::T__25)) {
		        		$this->errorHandler->recoverInline($this);
		        		} else {
		        			if ($this->input->LA(1) === Token::EOF) {
		        			    $this->matchedEOF = true;
		        		    }

		        			$this->errorHandler->reportMatch($this);
		        			$this->consume();
		        		}
		        		$this->setState(384);
		        		$this->multiplicative(); 
		        	}

		        	$this->setState(389);
		        	$this->errorHandler->sync($this);

		        	$alt = $this->getInterpreter()->adaptivePredict($this->input, 34, $this->ctx);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function multiplicative() : Context\MultiplicativeContext
		{
		    $localContext = new Context\MultiplicativeContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 72, self::RULE_multiplicative);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(390);
		        $this->unary();
		        $this->setState(395);
		        $this->errorHandler->sync($this);

		        $alt = $this->getInterpreter()->adaptivePredict($this->input, 35, $this->ctx);

		        while ($alt !== 2 && $alt !== ATN::INVALID_ALT_NUMBER) {
		        	if ($alt === 1) {
		        		$this->setState(391);

		        		$_la = $this->input->LA(1);

		        		if (!(((($_la) & ~0x3f) === 0 && ((1 << $_la) & ((1 << self::T__5) | (1 << self::T__26) | (1 << self::T__27))) !== 0))) {
		        		$this->errorHandler->recoverInline($this);
		        		} else {
		        			if ($this->input->LA(1) === Token::EOF) {
		        			    $this->matchedEOF = true;
		        		    }

		        			$this->errorHandler->reportMatch($this);
		        			$this->consume();
		        		}
		        		$this->setState(392);
		        		$this->unary(); 
		        	}

		        	$this->setState(397);
		        	$this->errorHandler->sync($this);

		        	$alt = $this->getInterpreter()->adaptivePredict($this->input, 35, $this->ctx);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function unary() : Context\UnaryContext
		{
		    $localContext = new Context\UnaryContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 74, self::RULE_unary);

		    try {
		        $this->setState(407);
		        $this->errorHandler->sync($this);

		        switch ($this->input->LA(1)) {
		            case self::T__2:
		            case self::T__6:
		            case self::T__14:
		            case self::TRUE:
		            case self::FALSE:
		            case self::NIL:
		            case self::INT32:
		            case self::FLOAT32:
		            case self::RUNE:
		            case self::STRING:
		            case self::ID:
		            	$localContext = new Context\PrimaryUnaryContext($localContext);
		            	$this->enterOuterAlt($localContext, 1);
		            	$this->setState(398);
		            	$this->primary();
		            	break;

		            case self::T__25:
		            	$localContext = new Context\NegativeUnaryContext($localContext);
		            	$this->enterOuterAlt($localContext, 2);
		            	$this->setState(399);
		            	$this->match(self::T__25);
		            	$this->setState(400);
		            	$this->unary();
		            	break;

		            case self::T__28:
		            	$localContext = new Context\NotUnaryContext($localContext);
		            	$this->enterOuterAlt($localContext, 3);
		            	$this->setState(401);
		            	$this->match(self::T__28);
		            	$this->setState(402);
		            	$this->unary();
		            	break;

		            case self::T__29:
		            	$localContext = new Context\AddressOfContext($localContext);
		            	$this->enterOuterAlt($localContext, 4);
		            	$this->setState(403);
		            	$this->match(self::T__29);
		            	$this->setState(404);
		            	$this->match(self::ID);
		            	break;

		            case self::T__5:
		            	$localContext = new Context\DereferenceContext($localContext);
		            	$this->enterOuterAlt($localContext, 5);
		            	$this->setState(405);
		            	$this->match(self::T__5);
		            	$this->setState(406);
		            	$this->unary();
		            	break;

		        default:
		        	throw new NoViableAltException($this);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function primary() : Context\PrimaryContext
		{
		    $localContext = new Context\PrimaryContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 76, self::RULE_primary);

		    try {
		        $this->setState(445);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 40, $this->ctx)) {
		        	case 1:
		        	    $localContext = new Context\IntLiteralContext($localContext);
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(409);
		        	    $this->match(self::INT32);
		        	break;

		        	case 2:
		        	    $localContext = new Context\FloatLiteralContext($localContext);
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(410);
		        	    $this->match(self::FLOAT32);
		        	break;

		        	case 3:
		        	    $localContext = new Context\RuneLiteralContext($localContext);
		        	    $this->enterOuterAlt($localContext, 3);
		        	    $this->setState(411);
		        	    $this->match(self::RUNE);
		        	break;

		        	case 4:
		        	    $localContext = new Context\StringLiteralContext($localContext);
		        	    $this->enterOuterAlt($localContext, 4);
		        	    $this->setState(412);
		        	    $this->match(self::STRING);
		        	break;

		        	case 5:
		        	    $localContext = new Context\TrueLiteralContext($localContext);
		        	    $this->enterOuterAlt($localContext, 5);
		        	    $this->setState(413);
		        	    $this->match(self::TRUE);
		        	break;

		        	case 6:
		        	    $localContext = new Context\FalseLiteralContext($localContext);
		        	    $this->enterOuterAlt($localContext, 6);
		        	    $this->setState(414);
		        	    $this->match(self::FALSE);
		        	break;

		        	case 7:
		        	    $localContext = new Context\NilLiteralContext($localContext);
		        	    $this->enterOuterAlt($localContext, 7);
		        	    $this->setState(415);
		        	    $this->match(self::NIL);
		        	break;

		        	case 8:
		        	    $localContext = new Context\FunctionCallContext($localContext);
		        	    $this->enterOuterAlt($localContext, 8);
		        	    $this->setState(416);
		        	    $this->match(self::ID);
		        	    $this->setState(419);
		        	    $this->errorHandler->sync($this);
		        	    $_la = $this->input->LA(1);

		        	    if ($_la === self::T__30) {
		        	    	$this->setState(417);
		        	    	$this->match(self::T__30);
		        	    	$this->setState(418);
		        	    	$this->match(self::ID);
		        	    }
		        	    $this->setState(421);
		        	    $this->match(self::T__2);
		        	    $this->setState(423);
		        	    $this->errorHandler->sync($this);
		        	    $_la = $this->input->LA(1);

		        	    if (((($_la) & ~0x3f) === 0 && ((1 << $_la) & ((1 << self::T__2) | (1 << self::T__5) | (1 << self::T__6) | (1 << self::T__14) | (1 << self::T__25) | (1 << self::T__28) | (1 << self::T__29) | (1 << self::TRUE) | (1 << self::FALSE) | (1 << self::NIL) | (1 << self::INT32) | (1 << self::FLOAT32) | (1 << self::RUNE) | (1 << self::STRING) | (1 << self::ID))) !== 0)) {
		        	    	$this->setState(422);
		        	    	$this->argumentList();
		        	    }
		        	    $this->setState(425);
		        	    $this->match(self::T__3);
		        	break;

		        	case 9:
		        	    $localContext = new Context\ArrayAccessContext($localContext);
		        	    $this->enterOuterAlt($localContext, 9);
		        	    $this->setState(426);
		        	    $this->match(self::ID);
		        	    $this->setState(431); 
		        	    $this->errorHandler->sync($this);

		        	    $alt = 1;

		        	    do {
		        	    	switch ($alt) {
		        	    	case 1:
		        	    		$this->setState(427);
		        	    		$this->match(self::T__6);
		        	    		$this->setState(428);
		        	    		$this->expression();
		        	    		$this->setState(429);
		        	    		$this->match(self::T__7);
		        	    		break;
		        	    	default:
		        	    		throw new NoViableAltException($this);
		        	    	}

		        	    	$this->setState(433); 
		        	    	$this->errorHandler->sync($this);

		        	    	$alt = $this->getInterpreter()->adaptivePredict($this->input, 39, $this->ctx);
		        	    } while ($alt !== 2 && $alt !== ATN::INVALID_ALT_NUMBER);
		        	break;

		        	case 10:
		        	    $localContext = new Context\IdentifierContext($localContext);
		        	    $this->enterOuterAlt($localContext, 10);
		        	    $this->setState(435);
		        	    $this->match(self::ID);
		        	break;

		        	case 11:
		        	    $localContext = new Context\GroupedExpressionContext($localContext);
		        	    $this->enterOuterAlt($localContext, 11);
		        	    $this->setState(436);
		        	    $this->match(self::T__2);
		        	    $this->setState(437);
		        	    $this->expression();
		        	    $this->setState(438);
		        	    $this->match(self::T__3);
		        	break;

		        	case 12:
		        	    $localContext = new Context\ArrayLiteralExprContext($localContext);
		        	    $this->enterOuterAlt($localContext, 12);
		        	    $this->setState(440);
		        	    $this->arrayLiteral();
		        	break;

		        	case 13:
		        	    $localContext = new Context\InnerArrayLiteralContext($localContext);
		        	    $this->enterOuterAlt($localContext, 13);
		        	    $this->setState(441);
		        	    $this->match(self::T__14);
		        	    $this->setState(442);
		        	    $this->expressionList();
		        	    $this->setState(443);
		        	    $this->match(self::T__15);
		        	break;
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function arrayLiteral() : Context\ArrayLiteralContext
		{
		    $localContext = new Context\ArrayLiteralContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 78, self::RULE_arrayLiteral);

		    try {
		        $this->setState(467);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 43, $this->ctx)) {
		        	case 1:
		        	    $localContext = new Context\FixedArrayLiteralNodeContext($localContext);
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(447);
		        	    $this->match(self::T__6);
		        	    $this->setState(448);
		        	    $this->expression();
		        	    $this->setState(449);
		        	    $this->match(self::T__7);
		        	    $this->setState(450);
		        	    $this->type();
		        	    $this->setState(451);
		        	    $this->match(self::T__14);
		        	    $this->setState(454);
		        	    $this->errorHandler->sync($this);

		        	    switch ($this->getInterpreter()->adaptivePredict($this->input, 41, $this->ctx)) {
		        	        case 1:
		        	    	    $this->setState(452);
		        	    	    $this->expressionList();
		        	    	break;

		        	        case 2:
		        	    	    $this->setState(453);
		        	    	    $this->innerLiteralList();
		        	    	break;
		        	    }
		        	    $this->setState(456);
		        	    $this->match(self::T__15);
		        	break;

		        	case 2:
		        	    $localContext = new Context\SliceLiteralNodeContext($localContext);
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(458);
		        	    $this->match(self::T__6);
		        	    $this->setState(459);
		        	    $this->match(self::T__7);
		        	    $this->setState(460);
		        	    $this->type();
		        	    $this->setState(461);
		        	    $this->match(self::T__14);
		        	    $this->setState(463);
		        	    $this->errorHandler->sync($this);
		        	    $_la = $this->input->LA(1);

		        	    if (((($_la) & ~0x3f) === 0 && ((1 << $_la) & ((1 << self::T__2) | (1 << self::T__5) | (1 << self::T__6) | (1 << self::T__14) | (1 << self::T__25) | (1 << self::T__28) | (1 << self::T__29) | (1 << self::TRUE) | (1 << self::FALSE) | (1 << self::NIL) | (1 << self::INT32) | (1 << self::FLOAT32) | (1 << self::RUNE) | (1 << self::STRING) | (1 << self::ID))) !== 0)) {
		        	    	$this->setState(462);
		        	    	$this->expressionList();
		        	    }
		        	    $this->setState(465);
		        	    $this->match(self::T__15);
		        	break;
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function innerLiteralList() : Context\InnerLiteralListContext
		{
		    $localContext = new Context\InnerLiteralListContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 80, self::RULE_innerLiteralList);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(469);
		        $this->innerLiteral();
		        $this->setState(474);
		        $this->errorHandler->sync($this);

		        $alt = $this->getInterpreter()->adaptivePredict($this->input, 44, $this->ctx);

		        while ($alt !== 2 && $alt !== ATN::INVALID_ALT_NUMBER) {
		        	if ($alt === 1) {
		        		$this->setState(470);
		        		$this->match(self::T__4);
		        		$this->setState(471);
		        		$this->innerLiteral(); 
		        	}

		        	$this->setState(476);
		        	$this->errorHandler->sync($this);

		        	$alt = $this->getInterpreter()->adaptivePredict($this->input, 44, $this->ctx);
		        }
		        $this->setState(478);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ($_la === self::T__4) {
		        	$this->setState(477);
		        	$this->match(self::T__4);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function innerLiteral() : Context\InnerLiteralContext
		{
		    $localContext = new Context\InnerLiteralContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 82, self::RULE_innerLiteral);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(480);
		        $this->match(self::T__14);
		        $this->setState(481);
		        $this->expressionList();
		        $this->setState(483);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ($_la === self::T__4) {
		        	$this->setState(482);
		        	$this->match(self::T__4);
		        }
		        $this->setState(485);
		        $this->match(self::T__15);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function argumentList() : Context\ArgumentListContext
		{
		    $localContext = new Context\ArgumentListContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 84, self::RULE_argumentList);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(487);
		        $this->argument();
		        $this->setState(492);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::T__4) {
		        	$this->setState(488);
		        	$this->match(self::T__4);
		        	$this->setState(489);
		        	$this->argument();
		        	$this->setState(494);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function argument() : Context\ArgumentContext
		{
		    $localContext = new Context\ArgumentContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 86, self::RULE_argument);

		    try {
		        $this->setState(498);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 48, $this->ctx)) {
		        	case 1:
		        	    $localContext = new Context\ExpressionArgumentContext($localContext);
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(495);
		        	    $this->expression();
		        	break;

		        	case 2:
		        	    $localContext = new Context\AddressArgumentContext($localContext);
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(496);
		        	    $this->match(self::T__29);
		        	    $this->setState(497);
		        	    $this->match(self::ID);
		        	break;
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function type() : Context\TypeContext
		{
		    $localContext = new Context\TypeContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 88, self::RULE_type);

		    try {
		        $this->setState(511);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 49, $this->ctx)) {
		        	case 1:
		        	    $localContext = new Context\BasicTypeContext($localContext);
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(500);
		        	    $this->match(self::ID);
		        	break;

		        	case 2:
		        	    $localContext = new Context\ArrayTypeContext($localContext);
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(501);
		        	    $this->match(self::T__6);
		        	    $this->setState(502);
		        	    $this->expression();
		        	    $this->setState(503);
		        	    $this->match(self::T__7);
		        	    $this->setState(504);
		        	    $this->type();
		        	break;

		        	case 3:
		        	    $localContext = new Context\SliceTypeContext($localContext);
		        	    $this->enterOuterAlt($localContext, 3);
		        	    $this->setState(506);
		        	    $this->match(self::T__6);
		        	    $this->setState(507);
		        	    $this->match(self::T__7);
		        	    $this->setState(508);
		        	    $this->type();
		        	break;

		        	case 4:
		        	    $localContext = new Context\PointerTypeContext($localContext);
		        	    $this->enterOuterAlt($localContext, 4);
		        	    $this->setState(509);
		        	    $this->match(self::T__5);
		        	    $this->setState(510);
		        	    $this->type();
		        	break;
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}
	}
}

namespace Context {
	use Antlr\Antlr4\Runtime\ParserRuleContext;
	use Antlr\Antlr4\Runtime\Token;
	use Antlr\Antlr4\Runtime\Tree\ParseTreeVisitor;
	use Antlr\Antlr4\Runtime\Tree\TerminalNode;
	use Antlr\Antlr4\Runtime\Tree\ParseTreeListener;
	use GolampiParser;
	use GolampiVisitor;

	class ProgramContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex() : int
		{
		    return GolampiParser::RULE_program;
	    }

	    public function EOF() : ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::EOF, 0);
	    }

	    /**
	     * @return array<DeclarationContext>|DeclarationContext|null
	     */
	    public function declaration(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(DeclarationContext::class);
	    	}

	        return $this->getTypedRuleContext(DeclarationContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitProgram($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class DeclarationContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex() : int
		{
		    return GolampiParser::RULE_declaration;
	    }

	    public function varDeclaration() : ?VarDeclarationContext
	    {
	    	return $this->getTypedRuleContext(VarDeclarationContext::class, 0);
	    }

	    public function constDeclaration() : ?ConstDeclarationContext
	    {
	    	return $this->getTypedRuleContext(ConstDeclarationContext::class, 0);
	    }

	    public function functionDeclaration() : ?FunctionDeclarationContext
	    {
	    	return $this->getTypedRuleContext(FunctionDeclarationContext::class, 0);
	    }

	    public function statement() : ?StatementContext
	    {
	    	return $this->getTypedRuleContext(StatementContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitDeclaration($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class VarDeclarationContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex() : int
		{
		    return GolampiParser::RULE_varDeclaration;
	    }
	 
		public function copyFrom(ParserRuleContext $context) : void
		{
			parent::copyFrom($context);

		}
	}

	class VarDeclSimpleContext extends VarDeclarationContext
	{
		public function __construct(VarDeclarationContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function VAR() : ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::VAR, 0);
	    }

	    public function idList() : ?IdListContext
	    {
	    	return $this->getTypedRuleContext(IdListContext::class, 0);
	    }

	    public function type() : ?TypeContext
	    {
	    	return $this->getTypedRuleContext(TypeContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitVarDeclSimple($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class VarDeclWithInitContext extends VarDeclarationContext
	{
		public function __construct(VarDeclarationContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function VAR() : ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::VAR, 0);
	    }

	    public function idList() : ?IdListContext
	    {
	    	return $this->getTypedRuleContext(IdListContext::class, 0);
	    }

	    public function type() : ?TypeContext
	    {
	    	return $this->getTypedRuleContext(TypeContext::class, 0);
	    }

	    public function expressionList() : ?ExpressionListContext
	    {
	    	return $this->getTypedRuleContext(ExpressionListContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitVarDeclWithInit($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ShortVarDeclarationContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex() : int
		{
		    return GolampiParser::RULE_shortVarDeclaration;
	    }
	 
		public function copyFrom(ParserRuleContext $context) : void
		{
			parent::copyFrom($context);

		}
	}

	class ShortVarDeclContext extends ShortVarDeclarationContext
	{
		public function __construct(ShortVarDeclarationContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function idList() : ?IdListContext
	    {
	    	return $this->getTypedRuleContext(IdListContext::class, 0);
	    }

	    public function expressionList() : ?ExpressionListContext
	    {
	    	return $this->getTypedRuleContext(ExpressionListContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitShortVarDecl($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ConstDeclarationContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex() : int
		{
		    return GolampiParser::RULE_constDeclaration;
	    }
	 
		public function copyFrom(ParserRuleContext $context) : void
		{
			parent::copyFrom($context);

		}
	}

	class ConstDeclContext extends ConstDeclarationContext
	{
		public function __construct(ConstDeclarationContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function CONST() : ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::CONST, 0);
	    }

	    public function ID() : ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::ID, 0);
	    }

	    public function type() : ?TypeContext
	    {
	    	return $this->getTypedRuleContext(TypeContext::class, 0);
	    }

	    public function expression() : ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitConstDecl($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class FunctionDeclarationContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex() : int
		{
		    return GolampiParser::RULE_functionDeclaration;
	    }
	 
		public function copyFrom(ParserRuleContext $context) : void
		{
			parent::copyFrom($context);

		}
	}

	class FuncDeclSingleReturnContext extends FunctionDeclarationContext
	{
		public function __construct(FunctionDeclarationContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function FUNC() : ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::FUNC, 0);
	    }

	    public function ID() : ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::ID, 0);
	    }

	    public function block() : ?BlockContext
	    {
	    	return $this->getTypedRuleContext(BlockContext::class, 0);
	    }

	    public function parameterList() : ?ParameterListContext
	    {
	    	return $this->getTypedRuleContext(ParameterListContext::class, 0);
	    }

	    public function type() : ?TypeContext
	    {
	    	return $this->getTypedRuleContext(TypeContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitFuncDeclSingleReturn($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class FuncDeclMultiReturnContext extends FunctionDeclarationContext
	{
		public function __construct(FunctionDeclarationContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function FUNC() : ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::FUNC, 0);
	    }

	    public function ID() : ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::ID, 0);
	    }

	    public function typeList() : ?TypeListContext
	    {
	    	return $this->getTypedRuleContext(TypeListContext::class, 0);
	    }

	    public function block() : ?BlockContext
	    {
	    	return $this->getTypedRuleContext(BlockContext::class, 0);
	    }

	    public function parameterList() : ?ParameterListContext
	    {
	    	return $this->getTypedRuleContext(ParameterListContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitFuncDeclMultiReturn($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ParameterListContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex() : int
		{
		    return GolampiParser::RULE_parameterList;
	    }

	    /**
	     * @return array<ParameterContext>|ParameterContext|null
	     */
	    public function parameter(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ParameterContext::class);
	    	}

	        return $this->getTypedRuleContext(ParameterContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitParameterList($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ParameterContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex() : int
		{
		    return GolampiParser::RULE_parameter;
	    }
	 
		public function copyFrom(ParserRuleContext $context) : void
		{
			parent::copyFrom($context);

		}
	}

	class NormalParameterContext extends ParameterContext
	{
		public function __construct(ParameterContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function ID() : ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::ID, 0);
	    }

	    public function type() : ?TypeContext
	    {
	    	return $this->getTypedRuleContext(TypeContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitNormalParameter($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class PointerParameterContext extends ParameterContext
	{
		public function __construct(ParameterContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function ID() : ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::ID, 0);
	    }

	    public function type() : ?TypeContext
	    {
	    	return $this->getTypedRuleContext(TypeContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitPointerParameter($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class TypeListContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex() : int
		{
		    return GolampiParser::RULE_typeList;
	    }

	    /**
	     * @return array<TypeContext>|TypeContext|null
	     */
	    public function type(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(TypeContext::class);
	    	}

	        return $this->getTypedRuleContext(TypeContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitTypeList($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class IdListContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex() : int
		{
		    return GolampiParser::RULE_idList;
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function ID(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiParser::ID);
	    	}

	        return $this->getToken(GolampiParser::ID, $index);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitIdList($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ExpressionListContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex() : int
		{
		    return GolampiParser::RULE_expressionList;
	    }

	    /**
	     * @return array<ExpressionContext>|ExpressionContext|null
	     */
	    public function expression(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExpressionContext::class);
	    	}

	        return $this->getTypedRuleContext(ExpressionContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitExpressionList($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class StatementContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex() : int
		{
		    return GolampiParser::RULE_statement;
	    }

	    public function shortVarDeclaration() : ?ShortVarDeclarationContext
	    {
	    	return $this->getTypedRuleContext(ShortVarDeclarationContext::class, 0);
	    }

	    public function assignment() : ?AssignmentContext
	    {
	    	return $this->getTypedRuleContext(AssignmentContext::class, 0);
	    }

	    public function ifStatement() : ?IfStatementContext
	    {
	    	return $this->getTypedRuleContext(IfStatementContext::class, 0);
	    }

	    public function switchStatement() : ?SwitchStatementContext
	    {
	    	return $this->getTypedRuleContext(SwitchStatementContext::class, 0);
	    }

	    public function forStatement() : ?ForStatementContext
	    {
	    	return $this->getTypedRuleContext(ForStatementContext::class, 0);
	    }

	    public function breakStatement() : ?BreakStatementContext
	    {
	    	return $this->getTypedRuleContext(BreakStatementContext::class, 0);
	    }

	    public function continueStatement() : ?ContinueStatementContext
	    {
	    	return $this->getTypedRuleContext(ContinueStatementContext::class, 0);
	    }

	    public function returnStatement() : ?ReturnStatementContext
	    {
	    	return $this->getTypedRuleContext(ReturnStatementContext::class, 0);
	    }

	    public function incDecStatement() : ?IncDecStatementContext
	    {
	    	return $this->getTypedRuleContext(IncDecStatementContext::class, 0);
	    }

	    public function block() : ?BlockContext
	    {
	    	return $this->getTypedRuleContext(BlockContext::class, 0);
	    }

	    public function expressionStatement() : ?ExpressionStatementContext
	    {
	    	return $this->getTypedRuleContext(ExpressionStatementContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitStatement($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class AssignmentContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex() : int
		{
		    return GolampiParser::RULE_assignment;
	    }
	 
		public function copyFrom(ParserRuleContext $context) : void
		{
			parent::copyFrom($context);

		}
	}

	class PointerAssignmentContext extends AssignmentContext
	{
		public function __construct(AssignmentContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function ID() : ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::ID, 0);
	    }

	    public function assignOp() : ?AssignOpContext
	    {
	    	return $this->getTypedRuleContext(AssignOpContext::class, 0);
	    }

	    public function expression() : ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitPointerAssignment($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class SimpleAssignmentContext extends AssignmentContext
	{
		public function __construct(AssignmentContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function ID() : ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::ID, 0);
	    }

	    public function assignOp() : ?AssignOpContext
	    {
	    	return $this->getTypedRuleContext(AssignOpContext::class, 0);
	    }

	    public function expression() : ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitSimpleAssignment($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class ArrayAssignmentContext extends AssignmentContext
	{
		public function __construct(AssignmentContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function ID() : ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::ID, 0);
	    }

	    public function assignOp() : ?AssignOpContext
	    {
	    	return $this->getTypedRuleContext(AssignOpContext::class, 0);
	    }

	    /**
	     * @return array<ExpressionContext>|ExpressionContext|null
	     */
	    public function expression(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExpressionContext::class);
	    	}

	        return $this->getTypedRuleContext(ExpressionContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitArrayAssignment($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class AssignOpContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex() : int
		{
		    return GolampiParser::RULE_assignOp;
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitAssignOp($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class IncDecStatementContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex() : int
		{
		    return GolampiParser::RULE_incDecStatement;
	    }
	 
		public function copyFrom(ParserRuleContext $context) : void
		{
			parent::copyFrom($context);

		}
	}

	class DecrementStatementContext extends IncDecStatementContext
	{
		public function __construct(IncDecStatementContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function ID() : ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::ID, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitDecrementStatement($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class IncrementStatementContext extends IncDecStatementContext
	{
		public function __construct(IncDecStatementContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function ID() : ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::ID, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitIncrementStatement($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class IfStatementContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex() : int
		{
		    return GolampiParser::RULE_ifStatement;
	    }
	 
		public function copyFrom(ParserRuleContext $context) : void
		{
			parent::copyFrom($context);

		}
	}

	class IfElseIfElseContext extends IfStatementContext
	{
		public function __construct(IfStatementContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function IF(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiParser::IF);
	    	}

	        return $this->getToken(GolampiParser::IF, $index);
	    }

	    /**
	     * @return array<ExpressionContext>|ExpressionContext|null
	     */
	    public function expression(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExpressionContext::class);
	    	}

	        return $this->getTypedRuleContext(ExpressionContext::class, $index);
	    }

	    /**
	     * @return array<BlockContext>|BlockContext|null
	     */
	    public function block(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(BlockContext::class);
	    	}

	        return $this->getTypedRuleContext(BlockContext::class, $index);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function ELSE(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiParser::ELSE);
	    	}

	        return $this->getToken(GolampiParser::ELSE, $index);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitIfElseIfElse($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class SwitchStatementContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex() : int
		{
		    return GolampiParser::RULE_switchStatement;
	    }

	    public function SWITCH() : ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::SWITCH, 0);
	    }

	    public function expression() : ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

	    /**
	     * @return array<CaseClauseContext>|CaseClauseContext|null
	     */
	    public function caseClause(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(CaseClauseContext::class);
	    	}

	        return $this->getTypedRuleContext(CaseClauseContext::class, $index);
	    }

	    public function defaultClause() : ?DefaultClauseContext
	    {
	    	return $this->getTypedRuleContext(DefaultClauseContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitSwitchStatement($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class CaseClauseContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex() : int
		{
		    return GolampiParser::RULE_caseClause;
	    }

	    public function CASE() : ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::CASE, 0);
	    }

	    public function caseExpressionList() : ?CaseExpressionListContext
	    {
	    	return $this->getTypedRuleContext(CaseExpressionListContext::class, 0);
	    }

	    /**
	     * @return array<StatementContext>|StatementContext|null
	     */
	    public function statement(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(StatementContext::class);
	    	}

	        return $this->getTypedRuleContext(StatementContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitCaseClause($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class CaseExpressionListContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex() : int
		{
		    return GolampiParser::RULE_caseExpressionList;
	    }

	    /**
	     * @return array<CaseExpressionContext>|CaseExpressionContext|null
	     */
	    public function caseExpression(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(CaseExpressionContext::class);
	    	}

	        return $this->getTypedRuleContext(CaseExpressionContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitCaseExpressionList($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class CaseExpressionContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex() : int
		{
		    return GolampiParser::RULE_caseExpression;
	    }
	 
		public function copyFrom(ParserRuleContext $context) : void
		{
			parent::copyFrom($context);

		}
	}

	class RangeCaseExprContext extends CaseExpressionContext
	{
		public function __construct(CaseExpressionContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    /**
	     * @return array<ExpressionContext>|ExpressionContext|null
	     */
	    public function expression(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExpressionContext::class);
	    	}

	        return $this->getTypedRuleContext(ExpressionContext::class, $index);
	    }

	    public function RANGE() : ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::RANGE, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitRangeCaseExpr($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class SingleCaseExprContext extends CaseExpressionContext
	{
		public function __construct(CaseExpressionContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function expression() : ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitSingleCaseExpr($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class DefaultClauseContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex() : int
		{
		    return GolampiParser::RULE_defaultClause;
	    }

	    public function DEFAULT() : ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::DEFAULT, 0);
	    }

	    /**
	     * @return array<StatementContext>|StatementContext|null
	     */
	    public function statement(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(StatementContext::class);
	    	}

	        return $this->getTypedRuleContext(StatementContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitDefaultClause($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ForStatementContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex() : int
		{
		    return GolampiParser::RULE_forStatement;
	    }
	 
		public function copyFrom(ParserRuleContext $context) : void
		{
			parent::copyFrom($context);

		}
	}

	class ForTraditionalContext extends ForStatementContext
	{
		public function __construct(ForStatementContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function FOR() : ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::FOR, 0);
	    }

	    public function forClause() : ?ForClauseContext
	    {
	    	return $this->getTypedRuleContext(ForClauseContext::class, 0);
	    }

	    public function block() : ?BlockContext
	    {
	    	return $this->getTypedRuleContext(BlockContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitForTraditional($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class ForWhileContext extends ForStatementContext
	{
		public function __construct(ForStatementContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function FOR() : ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::FOR, 0);
	    }

	    public function expression() : ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

	    public function block() : ?BlockContext
	    {
	    	return $this->getTypedRuleContext(BlockContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitForWhile($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class ForInfiniteContext extends ForStatementContext
	{
		public function __construct(ForStatementContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function FOR() : ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::FOR, 0);
	    }

	    public function block() : ?BlockContext
	    {
	    	return $this->getTypedRuleContext(BlockContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitForInfinite($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ForClauseContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex() : int
		{
		    return GolampiParser::RULE_forClause;
	    }

	    public function forInit() : ?ForInitContext
	    {
	    	return $this->getTypedRuleContext(ForInitContext::class, 0);
	    }

	    public function forPost() : ?ForPostContext
	    {
	    	return $this->getTypedRuleContext(ForPostContext::class, 0);
	    }

	    public function expression() : ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitForClause($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ForInitContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex() : int
		{
		    return GolampiParser::RULE_forInit;
	    }

	    public function varDeclaration() : ?VarDeclarationContext
	    {
	    	return $this->getTypedRuleContext(VarDeclarationContext::class, 0);
	    }

	    public function shortVarDeclaration() : ?ShortVarDeclarationContext
	    {
	    	return $this->getTypedRuleContext(ShortVarDeclarationContext::class, 0);
	    }

	    public function assignment() : ?AssignmentContext
	    {
	    	return $this->getTypedRuleContext(AssignmentContext::class, 0);
	    }

	    public function incDecStatement() : ?IncDecStatementContext
	    {
	    	return $this->getTypedRuleContext(IncDecStatementContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitForInit($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ForPostContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex() : int
		{
		    return GolampiParser::RULE_forPost;
	    }

	    public function assignment() : ?AssignmentContext
	    {
	    	return $this->getTypedRuleContext(AssignmentContext::class, 0);
	    }

	    public function incDecStatement() : ?IncDecStatementContext
	    {
	    	return $this->getTypedRuleContext(IncDecStatementContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitForPost($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class BreakStatementContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex() : int
		{
		    return GolampiParser::RULE_breakStatement;
	    }

	    public function BREAK() : ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::BREAK, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitBreakStatement($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ContinueStatementContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex() : int
		{
		    return GolampiParser::RULE_continueStatement;
	    }

	    public function CONTINUE() : ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::CONTINUE, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitContinueStatement($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ReturnStatementContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex() : int
		{
		    return GolampiParser::RULE_returnStatement;
	    }

	    public function RETURN() : ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::RETURN, 0);
	    }

	    public function expressionList() : ?ExpressionListContext
	    {
	    	return $this->getTypedRuleContext(ExpressionListContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitReturnStatement($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class BlockContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex() : int
		{
		    return GolampiParser::RULE_block;
	    }

	    /**
	     * @return array<DeclarationContext>|DeclarationContext|null
	     */
	    public function declaration(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(DeclarationContext::class);
	    	}

	        return $this->getTypedRuleContext(DeclarationContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitBlock($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ExpressionStatementContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex() : int
		{
		    return GolampiParser::RULE_expressionStatement;
	    }

	    public function expression() : ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitExpressionStatement($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ExpressionContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex() : int
		{
		    return GolampiParser::RULE_expression;
	    }

	    public function logicalOr() : ?LogicalOrContext
	    {
	    	return $this->getTypedRuleContext(LogicalOrContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitExpression($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class LogicalOrContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex() : int
		{
		    return GolampiParser::RULE_logicalOr;
	    }

	    /**
	     * @return array<LogicalAndContext>|LogicalAndContext|null
	     */
	    public function logicalAnd(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(LogicalAndContext::class);
	    	}

	        return $this->getTypedRuleContext(LogicalAndContext::class, $index);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function OR(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiParser::OR);
	    	}

	        return $this->getToken(GolampiParser::OR, $index);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitLogicalOr($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class LogicalAndContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex() : int
		{
		    return GolampiParser::RULE_logicalAnd;
	    }

	    /**
	     * @return array<EqualityContext>|EqualityContext|null
	     */
	    public function equality(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(EqualityContext::class);
	    	}

	        return $this->getTypedRuleContext(EqualityContext::class, $index);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function AND(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiParser::AND);
	    	}

	        return $this->getToken(GolampiParser::AND, $index);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitLogicalAnd($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class EqualityContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex() : int
		{
		    return GolampiParser::RULE_equality;
	    }

	    /**
	     * @return array<RelationalContext>|RelationalContext|null
	     */
	    public function relational(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(RelationalContext::class);
	    	}

	        return $this->getTypedRuleContext(RelationalContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitEquality($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class RelationalContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex() : int
		{
		    return GolampiParser::RULE_relational;
	    }

	    /**
	     * @return array<AdditiveContext>|AdditiveContext|null
	     */
	    public function additive(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(AdditiveContext::class);
	    	}

	        return $this->getTypedRuleContext(AdditiveContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitRelational($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class AdditiveContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex() : int
		{
		    return GolampiParser::RULE_additive;
	    }

	    /**
	     * @return array<MultiplicativeContext>|MultiplicativeContext|null
	     */
	    public function multiplicative(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(MultiplicativeContext::class);
	    	}

	        return $this->getTypedRuleContext(MultiplicativeContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitAdditive($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class MultiplicativeContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex() : int
		{
		    return GolampiParser::RULE_multiplicative;
	    }

	    /**
	     * @return array<UnaryContext>|UnaryContext|null
	     */
	    public function unary(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(UnaryContext::class);
	    	}

	        return $this->getTypedRuleContext(UnaryContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitMultiplicative($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class UnaryContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex() : int
		{
		    return GolampiParser::RULE_unary;
	    }
	 
		public function copyFrom(ParserRuleContext $context) : void
		{
			parent::copyFrom($context);

		}
	}

	class AddressOfContext extends UnaryContext
	{
		public function __construct(UnaryContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function ID() : ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::ID, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitAddressOf($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class NegativeUnaryContext extends UnaryContext
	{
		public function __construct(UnaryContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function unary() : ?UnaryContext
	    {
	    	return $this->getTypedRuleContext(UnaryContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitNegativeUnary($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class NotUnaryContext extends UnaryContext
	{
		public function __construct(UnaryContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function unary() : ?UnaryContext
	    {
	    	return $this->getTypedRuleContext(UnaryContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitNotUnary($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class DereferenceContext extends UnaryContext
	{
		public function __construct(UnaryContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function unary() : ?UnaryContext
	    {
	    	return $this->getTypedRuleContext(UnaryContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitDereference($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class PrimaryUnaryContext extends UnaryContext
	{
		public function __construct(UnaryContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function primary() : ?PrimaryContext
	    {
	    	return $this->getTypedRuleContext(PrimaryContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitPrimaryUnary($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class PrimaryContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex() : int
		{
		    return GolampiParser::RULE_primary;
	    }
	 
		public function copyFrom(ParserRuleContext $context) : void
		{
			parent::copyFrom($context);

		}
	}

	class FloatLiteralContext extends PrimaryContext
	{
		public function __construct(PrimaryContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function FLOAT32() : ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::FLOAT32, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitFloatLiteral($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class GroupedExpressionContext extends PrimaryContext
	{
		public function __construct(PrimaryContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function expression() : ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitGroupedExpression($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class FalseLiteralContext extends PrimaryContext
	{
		public function __construct(PrimaryContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function FALSE() : ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::FALSE, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitFalseLiteral($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class ArrayAccessContext extends PrimaryContext
	{
		public function __construct(PrimaryContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function ID() : ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::ID, 0);
	    }

	    /**
	     * @return array<ExpressionContext>|ExpressionContext|null
	     */
	    public function expression(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExpressionContext::class);
	    	}

	        return $this->getTypedRuleContext(ExpressionContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitArrayAccess($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class IdentifierContext extends PrimaryContext
	{
		public function __construct(PrimaryContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function ID() : ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::ID, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitIdentifier($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class StringLiteralContext extends PrimaryContext
	{
		public function __construct(PrimaryContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function STRING() : ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::STRING, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitStringLiteral($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class TrueLiteralContext extends PrimaryContext
	{
		public function __construct(PrimaryContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function TRUE() : ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::TRUE, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitTrueLiteral($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class InnerArrayLiteralContext extends PrimaryContext
	{
		public function __construct(PrimaryContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function expressionList() : ?ExpressionListContext
	    {
	    	return $this->getTypedRuleContext(ExpressionListContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitInnerArrayLiteral($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class NilLiteralContext extends PrimaryContext
	{
		public function __construct(PrimaryContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function NIL() : ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::NIL, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitNilLiteral($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class ArrayLiteralExprContext extends PrimaryContext
	{
		public function __construct(PrimaryContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function arrayLiteral() : ?ArrayLiteralContext
	    {
	    	return $this->getTypedRuleContext(ArrayLiteralContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitArrayLiteralExpr($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class IntLiteralContext extends PrimaryContext
	{
		public function __construct(PrimaryContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function INT32() : ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::INT32, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitIntLiteral($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class FunctionCallContext extends PrimaryContext
	{
		public function __construct(PrimaryContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function ID(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiParser::ID);
	    	}

	        return $this->getToken(GolampiParser::ID, $index);
	    }

	    public function argumentList() : ?ArgumentListContext
	    {
	    	return $this->getTypedRuleContext(ArgumentListContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitFunctionCall($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class RuneLiteralContext extends PrimaryContext
	{
		public function __construct(PrimaryContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function RUNE() : ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::RUNE, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitRuneLiteral($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ArrayLiteralContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex() : int
		{
		    return GolampiParser::RULE_arrayLiteral;
	    }
	 
		public function copyFrom(ParserRuleContext $context) : void
		{
			parent::copyFrom($context);

		}
	}

	class FixedArrayLiteralNodeContext extends ArrayLiteralContext
	{
		public function __construct(ArrayLiteralContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function expression() : ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

	    public function type() : ?TypeContext
	    {
	    	return $this->getTypedRuleContext(TypeContext::class, 0);
	    }

	    public function expressionList() : ?ExpressionListContext
	    {
	    	return $this->getTypedRuleContext(ExpressionListContext::class, 0);
	    }

	    public function innerLiteralList() : ?InnerLiteralListContext
	    {
	    	return $this->getTypedRuleContext(InnerLiteralListContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitFixedArrayLiteralNode($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class SliceLiteralNodeContext extends ArrayLiteralContext
	{
		public function __construct(ArrayLiteralContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function type() : ?TypeContext
	    {
	    	return $this->getTypedRuleContext(TypeContext::class, 0);
	    }

	    public function expressionList() : ?ExpressionListContext
	    {
	    	return $this->getTypedRuleContext(ExpressionListContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitSliceLiteralNode($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class InnerLiteralListContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex() : int
		{
		    return GolampiParser::RULE_innerLiteralList;
	    }

	    /**
	     * @return array<InnerLiteralContext>|InnerLiteralContext|null
	     */
	    public function innerLiteral(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(InnerLiteralContext::class);
	    	}

	        return $this->getTypedRuleContext(InnerLiteralContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitInnerLiteralList($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class InnerLiteralContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex() : int
		{
		    return GolampiParser::RULE_innerLiteral;
	    }

	    public function expressionList() : ?ExpressionListContext
	    {
	    	return $this->getTypedRuleContext(ExpressionListContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitInnerLiteral($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ArgumentListContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex() : int
		{
		    return GolampiParser::RULE_argumentList;
	    }

	    /**
	     * @return array<ArgumentContext>|ArgumentContext|null
	     */
	    public function argument(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ArgumentContext::class);
	    	}

	        return $this->getTypedRuleContext(ArgumentContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitArgumentList($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ArgumentContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex() : int
		{
		    return GolampiParser::RULE_argument;
	    }
	 
		public function copyFrom(ParserRuleContext $context) : void
		{
			parent::copyFrom($context);

		}
	}

	class AddressArgumentContext extends ArgumentContext
	{
		public function __construct(ArgumentContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function ID() : ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::ID, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitAddressArgument($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class ExpressionArgumentContext extends ArgumentContext
	{
		public function __construct(ArgumentContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function expression() : ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitExpressionArgument($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class TypeContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex() : int
		{
		    return GolampiParser::RULE_type;
	    }
	 
		public function copyFrom(ParserRuleContext $context) : void
		{
			parent::copyFrom($context);

		}
	}

	class ArrayTypeContext extends TypeContext
	{
		public function __construct(TypeContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function expression() : ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

	    public function type() : ?TypeContext
	    {
	    	return $this->getTypedRuleContext(TypeContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitArrayType($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class BasicTypeContext extends TypeContext
	{
		public function __construct(TypeContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function ID() : ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::ID, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitBasicType($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class SliceTypeContext extends TypeContext
	{
		public function __construct(TypeContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function type() : ?TypeContext
	    {
	    	return $this->getTypedRuleContext(TypeContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitSliceType($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class PointerTypeContext extends TypeContext
	{
		public function __construct(TypeContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function type() : ?TypeContext
	    {
	    	return $this->getTypedRuleContext(TypeContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitPointerType($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 
}