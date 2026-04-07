// Generated from /home/isai/Documentos/Github/OLC2_Proyecto1_202308204/Backend/Golampi.g4 by ANTLR 4.13.1
import org.antlr.v4.runtime.atn.*;
import org.antlr.v4.runtime.dfa.DFA;
import org.antlr.v4.runtime.*;
import org.antlr.v4.runtime.misc.*;
import org.antlr.v4.runtime.tree.*;
import java.util.List;
import java.util.Iterator;
import java.util.ArrayList;

@SuppressWarnings({"all", "warnings", "unchecked", "unused", "cast", "CheckReturnValue"})
public class GolampiParser extends Parser {
	static { RuntimeMetaData.checkVersion("4.13.1", RuntimeMetaData.VERSION); }

	protected static final DFA[] _decisionToDFA;
	protected static final PredictionContextCache _sharedContextCache =
		new PredictionContextCache();
	public static final int
		T__0=1, T__1=2, T__2=3, T__3=4, T__4=5, T__5=6, T__6=7, T__7=8, T__8=9, 
		T__9=10, T__10=11, T__11=12, T__12=13, T__13=14, T__14=15, T__15=16, T__16=17, 
		T__17=18, T__18=19, T__19=20, T__20=21, T__21=22, T__22=23, T__23=24, 
		T__24=25, T__25=26, T__26=27, T__27=28, T__28=29, T__29=30, T__30=31, 
		VAR=32, CONST=33, FUNC=34, IF=35, ELSE=36, SWITCH=37, CASE=38, DEFAULT=39, 
		FOR=40, BREAK=41, CONTINUE=42, RETURN=43, TRUE=44, FALSE=45, NIL=46, AND=47, 
		OR=48, RANGE=49, INT32=50, FLOAT32=51, RUNE=52, STRING=53, ID=54, LINE_COMMENT=55, 
		BLOCK_COMMENT=56, WS=57;
	public static final int
		RULE_program = 0, RULE_declaration = 1, RULE_varDeclaration = 2, RULE_shortVarDeclaration = 3, 
		RULE_constDeclaration = 4, RULE_functionDeclaration = 5, RULE_parameterList = 6, 
		RULE_parameter = 7, RULE_typeList = 8, RULE_idList = 9, RULE_expressionList = 10, 
		RULE_statement = 11, RULE_assignment = 12, RULE_assignOp = 13, RULE_incDecStatement = 14, 
		RULE_ifStatement = 15, RULE_switchStatement = 16, RULE_caseClause = 17, 
		RULE_caseExpressionList = 18, RULE_caseExpression = 19, RULE_defaultClause = 20, 
		RULE_forStatement = 21, RULE_forClause = 22, RULE_forInit = 23, RULE_forPost = 24, 
		RULE_breakStatement = 25, RULE_continueStatement = 26, RULE_returnStatement = 27, 
		RULE_block = 28, RULE_expressionStatement = 29, RULE_expression = 30, 
		RULE_logicalOr = 31, RULE_logicalAnd = 32, RULE_equality = 33, RULE_relational = 34, 
		RULE_additive = 35, RULE_multiplicative = 36, RULE_unary = 37, RULE_primary = 38, 
		RULE_arrayLiteral = 39, RULE_innerLiteralList = 40, RULE_innerLiteral = 41, 
		RULE_argumentList = 42, RULE_argument = 43, RULE_type = 44;
	private static String[] makeRuleNames() {
		return new String[] {
			"program", "declaration", "varDeclaration", "shortVarDeclaration", "constDeclaration", 
			"functionDeclaration", "parameterList", "parameter", "typeList", "idList", 
			"expressionList", "statement", "assignment", "assignOp", "incDecStatement", 
			"ifStatement", "switchStatement", "caseClause", "caseExpressionList", 
			"caseExpression", "defaultClause", "forStatement", "forClause", "forInit", 
			"forPost", "breakStatement", "continueStatement", "returnStatement", 
			"block", "expressionStatement", "expression", "logicalOr", "logicalAnd", 
			"equality", "relational", "additive", "multiplicative", "unary", "primary", 
			"arrayLiteral", "innerLiteralList", "innerLiteral", "argumentList", "argument", 
			"type"
		};
	}
	public static final String[] ruleNames = makeRuleNames();

	private static String[] makeLiteralNames() {
		return new String[] {
			null, "'='", "':='", "'('", "')'", "','", "'*'", "'['", "']'", "'+='", 
			"'-='", "'*='", "'/='", "'++'", "'--'", "'{'", "'}'", "':'", "';'", "'=='", 
			"'!='", "'>'", "'>='", "'<'", "'<='", "'+'", "'-'", "'/'", "'%'", "'!'", 
			"'&'", "'.'", "'var'", "'const'", "'func'", "'if'", "'else'", "'switch'", 
			"'case'", "'default'", "'for'", "'break'", "'continue'", "'return'", 
			"'true'", "'false'", "'nil'", "'&&'", "'||'", "'..'"
		};
	}
	private static final String[] _LITERAL_NAMES = makeLiteralNames();
	private static String[] makeSymbolicNames() {
		return new String[] {
			null, null, null, null, null, null, null, null, null, null, null, null, 
			null, null, null, null, null, null, null, null, null, null, null, null, 
			null, null, null, null, null, null, null, null, "VAR", "CONST", "FUNC", 
			"IF", "ELSE", "SWITCH", "CASE", "DEFAULT", "FOR", "BREAK", "CONTINUE", 
			"RETURN", "TRUE", "FALSE", "NIL", "AND", "OR", "RANGE", "INT32", "FLOAT32", 
			"RUNE", "STRING", "ID", "LINE_COMMENT", "BLOCK_COMMENT", "WS"
		};
	}
	private static final String[] _SYMBOLIC_NAMES = makeSymbolicNames();
	public static final Vocabulary VOCABULARY = new VocabularyImpl(_LITERAL_NAMES, _SYMBOLIC_NAMES);

	/**
	 * @deprecated Use {@link #VOCABULARY} instead.
	 */
	@Deprecated
	public static final String[] tokenNames;
	static {
		tokenNames = new String[_SYMBOLIC_NAMES.length];
		for (int i = 0; i < tokenNames.length; i++) {
			tokenNames[i] = VOCABULARY.getLiteralName(i);
			if (tokenNames[i] == null) {
				tokenNames[i] = VOCABULARY.getSymbolicName(i);
			}

			if (tokenNames[i] == null) {
				tokenNames[i] = "<INVALID>";
			}
		}
	}

	@Override
	@Deprecated
	public String[] getTokenNames() {
		return tokenNames;
	}

	@Override

	public Vocabulary getVocabulary() {
		return VOCABULARY;
	}

	@Override
	public String getGrammarFileName() { return "Golampi.g4"; }

	@Override
	public String[] getRuleNames() { return ruleNames; }

	@Override
	public String getSerializedATN() { return _serializedATN; }

	@Override
	public ATN getATN() { return _ATN; }

	public GolampiParser(TokenStream input) {
		super(input);
		_interp = new ParserATNSimulator(this,_ATN,_decisionToDFA,_sharedContextCache);
	}

	@SuppressWarnings("CheckReturnValue")
	public static class ProgramContext extends ParserRuleContext {
		public TerminalNode EOF() { return getToken(GolampiParser.EOF, 0); }
		public List<DeclarationContext> declaration() {
			return getRuleContexts(DeclarationContext.class);
		}
		public DeclarationContext declaration(int i) {
			return getRuleContext(DeclarationContext.class,i);
		}
		public ProgramContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_program; }
	}

	public final ProgramContext program() throws RecognitionException {
		ProgramContext _localctx = new ProgramContext(_ctx, getState());
		enterRule(_localctx, 0, RULE_program);
		int _la;
		try {
			enterOuterAlt(_localctx, 1);
			{
			setState(93);
			_errHandler.sync(this);
			_la = _input.LA(1);
			while ((((_la) & ~0x3f) == 0 && ((1L << _la) & 35042738630066376L) != 0)) {
				{
				{
				setState(90);
				declaration();
				}
				}
				setState(95);
				_errHandler.sync(this);
				_la = _input.LA(1);
			}
			setState(96);
			match(EOF);
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class DeclarationContext extends ParserRuleContext {
		public VarDeclarationContext varDeclaration() {
			return getRuleContext(VarDeclarationContext.class,0);
		}
		public ConstDeclarationContext constDeclaration() {
			return getRuleContext(ConstDeclarationContext.class,0);
		}
		public FunctionDeclarationContext functionDeclaration() {
			return getRuleContext(FunctionDeclarationContext.class,0);
		}
		public StatementContext statement() {
			return getRuleContext(StatementContext.class,0);
		}
		public DeclarationContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_declaration; }
	}

	public final DeclarationContext declaration() throws RecognitionException {
		DeclarationContext _localctx = new DeclarationContext(_ctx, getState());
		enterRule(_localctx, 2, RULE_declaration);
		try {
			setState(102);
			_errHandler.sync(this);
			switch (_input.LA(1)) {
			case VAR:
				enterOuterAlt(_localctx, 1);
				{
				setState(98);
				varDeclaration();
				}
				break;
			case CONST:
				enterOuterAlt(_localctx, 2);
				{
				setState(99);
				constDeclaration();
				}
				break;
			case FUNC:
				enterOuterAlt(_localctx, 3);
				{
				setState(100);
				functionDeclaration();
				}
				break;
			case T__2:
			case T__5:
			case T__6:
			case T__14:
			case T__25:
			case T__28:
			case T__29:
			case IF:
			case SWITCH:
			case FOR:
			case BREAK:
			case CONTINUE:
			case RETURN:
			case TRUE:
			case FALSE:
			case NIL:
			case INT32:
			case FLOAT32:
			case RUNE:
			case STRING:
			case ID:
				enterOuterAlt(_localctx, 4);
				{
				setState(101);
				statement();
				}
				break;
			default:
				throw new NoViableAltException(this);
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class VarDeclarationContext extends ParserRuleContext {
		public VarDeclarationContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_varDeclaration; }
	 
		public VarDeclarationContext() { }
		public void copyFrom(VarDeclarationContext ctx) {
			super.copyFrom(ctx);
		}
	}
	@SuppressWarnings("CheckReturnValue")
	public static class VarDeclSimpleContext extends VarDeclarationContext {
		public TerminalNode VAR() { return getToken(GolampiParser.VAR, 0); }
		public IdListContext idList() {
			return getRuleContext(IdListContext.class,0);
		}
		public TypeContext type() {
			return getRuleContext(TypeContext.class,0);
		}
		public VarDeclSimpleContext(VarDeclarationContext ctx) { copyFrom(ctx); }
	}
	@SuppressWarnings("CheckReturnValue")
	public static class VarDeclWithInitContext extends VarDeclarationContext {
		public TerminalNode VAR() { return getToken(GolampiParser.VAR, 0); }
		public IdListContext idList() {
			return getRuleContext(IdListContext.class,0);
		}
		public TypeContext type() {
			return getRuleContext(TypeContext.class,0);
		}
		public ExpressionListContext expressionList() {
			return getRuleContext(ExpressionListContext.class,0);
		}
		public VarDeclWithInitContext(VarDeclarationContext ctx) { copyFrom(ctx); }
	}

	public final VarDeclarationContext varDeclaration() throws RecognitionException {
		VarDeclarationContext _localctx = new VarDeclarationContext(_ctx, getState());
		enterRule(_localctx, 4, RULE_varDeclaration);
		try {
			setState(114);
			_errHandler.sync(this);
			switch ( getInterpreter().adaptivePredict(_input,2,_ctx) ) {
			case 1:
				_localctx = new VarDeclSimpleContext(_localctx);
				enterOuterAlt(_localctx, 1);
				{
				setState(104);
				match(VAR);
				setState(105);
				idList();
				setState(106);
				type();
				}
				break;
			case 2:
				_localctx = new VarDeclWithInitContext(_localctx);
				enterOuterAlt(_localctx, 2);
				{
				setState(108);
				match(VAR);
				setState(109);
				idList();
				setState(110);
				type();
				setState(111);
				match(T__0);
				setState(112);
				expressionList();
				}
				break;
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class ShortVarDeclarationContext extends ParserRuleContext {
		public ShortVarDeclarationContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_shortVarDeclaration; }
	 
		public ShortVarDeclarationContext() { }
		public void copyFrom(ShortVarDeclarationContext ctx) {
			super.copyFrom(ctx);
		}
	}
	@SuppressWarnings("CheckReturnValue")
	public static class ShortVarDeclContext extends ShortVarDeclarationContext {
		public IdListContext idList() {
			return getRuleContext(IdListContext.class,0);
		}
		public ExpressionListContext expressionList() {
			return getRuleContext(ExpressionListContext.class,0);
		}
		public ShortVarDeclContext(ShortVarDeclarationContext ctx) { copyFrom(ctx); }
	}

	public final ShortVarDeclarationContext shortVarDeclaration() throws RecognitionException {
		ShortVarDeclarationContext _localctx = new ShortVarDeclarationContext(_ctx, getState());
		enterRule(_localctx, 6, RULE_shortVarDeclaration);
		try {
			_localctx = new ShortVarDeclContext(_localctx);
			enterOuterAlt(_localctx, 1);
			{
			setState(116);
			idList();
			setState(117);
			match(T__1);
			setState(118);
			expressionList();
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class ConstDeclarationContext extends ParserRuleContext {
		public ConstDeclarationContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_constDeclaration; }
	 
		public ConstDeclarationContext() { }
		public void copyFrom(ConstDeclarationContext ctx) {
			super.copyFrom(ctx);
		}
	}
	@SuppressWarnings("CheckReturnValue")
	public static class ConstDeclContext extends ConstDeclarationContext {
		public TerminalNode CONST() { return getToken(GolampiParser.CONST, 0); }
		public TerminalNode ID() { return getToken(GolampiParser.ID, 0); }
		public TypeContext type() {
			return getRuleContext(TypeContext.class,0);
		}
		public ExpressionContext expression() {
			return getRuleContext(ExpressionContext.class,0);
		}
		public ConstDeclContext(ConstDeclarationContext ctx) { copyFrom(ctx); }
	}

	public final ConstDeclarationContext constDeclaration() throws RecognitionException {
		ConstDeclarationContext _localctx = new ConstDeclarationContext(_ctx, getState());
		enterRule(_localctx, 8, RULE_constDeclaration);
		try {
			_localctx = new ConstDeclContext(_localctx);
			enterOuterAlt(_localctx, 1);
			{
			setState(120);
			match(CONST);
			setState(121);
			match(ID);
			setState(122);
			type();
			setState(123);
			match(T__0);
			setState(124);
			expression();
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class FunctionDeclarationContext extends ParserRuleContext {
		public FunctionDeclarationContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_functionDeclaration; }
	 
		public FunctionDeclarationContext() { }
		public void copyFrom(FunctionDeclarationContext ctx) {
			super.copyFrom(ctx);
		}
	}
	@SuppressWarnings("CheckReturnValue")
	public static class FuncDeclSingleReturnContext extends FunctionDeclarationContext {
		public TerminalNode FUNC() { return getToken(GolampiParser.FUNC, 0); }
		public TerminalNode ID() { return getToken(GolampiParser.ID, 0); }
		public BlockContext block() {
			return getRuleContext(BlockContext.class,0);
		}
		public ParameterListContext parameterList() {
			return getRuleContext(ParameterListContext.class,0);
		}
		public TypeContext type() {
			return getRuleContext(TypeContext.class,0);
		}
		public FuncDeclSingleReturnContext(FunctionDeclarationContext ctx) { copyFrom(ctx); }
	}
	@SuppressWarnings("CheckReturnValue")
	public static class FuncDeclMultiReturnContext extends FunctionDeclarationContext {
		public TerminalNode FUNC() { return getToken(GolampiParser.FUNC, 0); }
		public TerminalNode ID() { return getToken(GolampiParser.ID, 0); }
		public TypeListContext typeList() {
			return getRuleContext(TypeListContext.class,0);
		}
		public BlockContext block() {
			return getRuleContext(BlockContext.class,0);
		}
		public ParameterListContext parameterList() {
			return getRuleContext(ParameterListContext.class,0);
		}
		public FuncDeclMultiReturnContext(FunctionDeclarationContext ctx) { copyFrom(ctx); }
	}

	public final FunctionDeclarationContext functionDeclaration() throws RecognitionException {
		FunctionDeclarationContext _localctx = new FunctionDeclarationContext(_ctx, getState());
		enterRule(_localctx, 10, RULE_functionDeclaration);
		int _la;
		try {
			setState(149);
			_errHandler.sync(this);
			switch ( getInterpreter().adaptivePredict(_input,6,_ctx) ) {
			case 1:
				_localctx = new FuncDeclSingleReturnContext(_localctx);
				enterOuterAlt(_localctx, 1);
				{
				setState(126);
				match(FUNC);
				setState(127);
				match(ID);
				setState(128);
				match(T__2);
				setState(130);
				_errHandler.sync(this);
				_la = _input.LA(1);
				if (_la==T__5 || _la==ID) {
					{
					setState(129);
					parameterList();
					}
				}

				setState(132);
				match(T__3);
				setState(134);
				_errHandler.sync(this);
				_la = _input.LA(1);
				if ((((_la) & ~0x3f) == 0 && ((1L << _la) & 18014398509482176L) != 0)) {
					{
					setState(133);
					type();
					}
				}

				setState(136);
				block();
				}
				break;
			case 2:
				_localctx = new FuncDeclMultiReturnContext(_localctx);
				enterOuterAlt(_localctx, 2);
				{
				setState(137);
				match(FUNC);
				setState(138);
				match(ID);
				setState(139);
				match(T__2);
				setState(141);
				_errHandler.sync(this);
				_la = _input.LA(1);
				if (_la==T__5 || _la==ID) {
					{
					setState(140);
					parameterList();
					}
				}

				setState(143);
				match(T__3);
				setState(144);
				match(T__2);
				setState(145);
				typeList();
				setState(146);
				match(T__3);
				setState(147);
				block();
				}
				break;
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class ParameterListContext extends ParserRuleContext {
		public List<ParameterContext> parameter() {
			return getRuleContexts(ParameterContext.class);
		}
		public ParameterContext parameter(int i) {
			return getRuleContext(ParameterContext.class,i);
		}
		public ParameterListContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_parameterList; }
	}

	public final ParameterListContext parameterList() throws RecognitionException {
		ParameterListContext _localctx = new ParameterListContext(_ctx, getState());
		enterRule(_localctx, 12, RULE_parameterList);
		int _la;
		try {
			enterOuterAlt(_localctx, 1);
			{
			setState(151);
			parameter();
			setState(156);
			_errHandler.sync(this);
			_la = _input.LA(1);
			while (_la==T__4) {
				{
				{
				setState(152);
				match(T__4);
				setState(153);
				parameter();
				}
				}
				setState(158);
				_errHandler.sync(this);
				_la = _input.LA(1);
			}
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class ParameterContext extends ParserRuleContext {
		public ParameterContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_parameter; }
	 
		public ParameterContext() { }
		public void copyFrom(ParameterContext ctx) {
			super.copyFrom(ctx);
		}
	}
	@SuppressWarnings("CheckReturnValue")
	public static class NormalParameterContext extends ParameterContext {
		public TerminalNode ID() { return getToken(GolampiParser.ID, 0); }
		public TypeContext type() {
			return getRuleContext(TypeContext.class,0);
		}
		public NormalParameterContext(ParameterContext ctx) { copyFrom(ctx); }
	}
	@SuppressWarnings("CheckReturnValue")
	public static class PointerParameterContext extends ParameterContext {
		public TerminalNode ID() { return getToken(GolampiParser.ID, 0); }
		public TypeContext type() {
			return getRuleContext(TypeContext.class,0);
		}
		public PointerParameterContext(ParameterContext ctx) { copyFrom(ctx); }
	}

	public final ParameterContext parameter() throws RecognitionException {
		ParameterContext _localctx = new ParameterContext(_ctx, getState());
		enterRule(_localctx, 14, RULE_parameter);
		try {
			setState(164);
			_errHandler.sync(this);
			switch (_input.LA(1)) {
			case ID:
				_localctx = new NormalParameterContext(_localctx);
				enterOuterAlt(_localctx, 1);
				{
				setState(159);
				match(ID);
				setState(160);
				type();
				}
				break;
			case T__5:
				_localctx = new PointerParameterContext(_localctx);
				enterOuterAlt(_localctx, 2);
				{
				setState(161);
				match(T__5);
				setState(162);
				match(ID);
				setState(163);
				type();
				}
				break;
			default:
				throw new NoViableAltException(this);
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class TypeListContext extends ParserRuleContext {
		public List<TypeContext> type() {
			return getRuleContexts(TypeContext.class);
		}
		public TypeContext type(int i) {
			return getRuleContext(TypeContext.class,i);
		}
		public TypeListContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_typeList; }
	}

	public final TypeListContext typeList() throws RecognitionException {
		TypeListContext _localctx = new TypeListContext(_ctx, getState());
		enterRule(_localctx, 16, RULE_typeList);
		int _la;
		try {
			enterOuterAlt(_localctx, 1);
			{
			setState(166);
			type();
			setState(171);
			_errHandler.sync(this);
			_la = _input.LA(1);
			while (_la==T__4) {
				{
				{
				setState(167);
				match(T__4);
				setState(168);
				type();
				}
				}
				setState(173);
				_errHandler.sync(this);
				_la = _input.LA(1);
			}
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class IdListContext extends ParserRuleContext {
		public List<TerminalNode> ID() { return getTokens(GolampiParser.ID); }
		public TerminalNode ID(int i) {
			return getToken(GolampiParser.ID, i);
		}
		public IdListContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_idList; }
	}

	public final IdListContext idList() throws RecognitionException {
		IdListContext _localctx = new IdListContext(_ctx, getState());
		enterRule(_localctx, 18, RULE_idList);
		int _la;
		try {
			enterOuterAlt(_localctx, 1);
			{
			setState(174);
			match(ID);
			setState(179);
			_errHandler.sync(this);
			_la = _input.LA(1);
			while (_la==T__4) {
				{
				{
				setState(175);
				match(T__4);
				setState(176);
				match(ID);
				}
				}
				setState(181);
				_errHandler.sync(this);
				_la = _input.LA(1);
			}
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class ExpressionListContext extends ParserRuleContext {
		public List<ExpressionContext> expression() {
			return getRuleContexts(ExpressionContext.class);
		}
		public ExpressionContext expression(int i) {
			return getRuleContext(ExpressionContext.class,i);
		}
		public ExpressionListContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_expressionList; }
	}

	public final ExpressionListContext expressionList() throws RecognitionException {
		ExpressionListContext _localctx = new ExpressionListContext(_ctx, getState());
		enterRule(_localctx, 20, RULE_expressionList);
		try {
			int _alt;
			enterOuterAlt(_localctx, 1);
			{
			setState(182);
			expression();
			setState(187);
			_errHandler.sync(this);
			_alt = getInterpreter().adaptivePredict(_input,11,_ctx);
			while ( _alt!=2 && _alt!=org.antlr.v4.runtime.atn.ATN.INVALID_ALT_NUMBER ) {
				if ( _alt==1 ) {
					{
					{
					setState(183);
					match(T__4);
					setState(184);
					expression();
					}
					} 
				}
				setState(189);
				_errHandler.sync(this);
				_alt = getInterpreter().adaptivePredict(_input,11,_ctx);
			}
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class StatementContext extends ParserRuleContext {
		public ShortVarDeclarationContext shortVarDeclaration() {
			return getRuleContext(ShortVarDeclarationContext.class,0);
		}
		public AssignmentContext assignment() {
			return getRuleContext(AssignmentContext.class,0);
		}
		public IfStatementContext ifStatement() {
			return getRuleContext(IfStatementContext.class,0);
		}
		public SwitchStatementContext switchStatement() {
			return getRuleContext(SwitchStatementContext.class,0);
		}
		public ForStatementContext forStatement() {
			return getRuleContext(ForStatementContext.class,0);
		}
		public BreakStatementContext breakStatement() {
			return getRuleContext(BreakStatementContext.class,0);
		}
		public ContinueStatementContext continueStatement() {
			return getRuleContext(ContinueStatementContext.class,0);
		}
		public ReturnStatementContext returnStatement() {
			return getRuleContext(ReturnStatementContext.class,0);
		}
		public IncDecStatementContext incDecStatement() {
			return getRuleContext(IncDecStatementContext.class,0);
		}
		public BlockContext block() {
			return getRuleContext(BlockContext.class,0);
		}
		public ExpressionStatementContext expressionStatement() {
			return getRuleContext(ExpressionStatementContext.class,0);
		}
		public StatementContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_statement; }
	}

	public final StatementContext statement() throws RecognitionException {
		StatementContext _localctx = new StatementContext(_ctx, getState());
		enterRule(_localctx, 22, RULE_statement);
		try {
			setState(201);
			_errHandler.sync(this);
			switch ( getInterpreter().adaptivePredict(_input,12,_ctx) ) {
			case 1:
				enterOuterAlt(_localctx, 1);
				{
				setState(190);
				shortVarDeclaration();
				}
				break;
			case 2:
				enterOuterAlt(_localctx, 2);
				{
				setState(191);
				assignment();
				}
				break;
			case 3:
				enterOuterAlt(_localctx, 3);
				{
				setState(192);
				ifStatement();
				}
				break;
			case 4:
				enterOuterAlt(_localctx, 4);
				{
				setState(193);
				switchStatement();
				}
				break;
			case 5:
				enterOuterAlt(_localctx, 5);
				{
				setState(194);
				forStatement();
				}
				break;
			case 6:
				enterOuterAlt(_localctx, 6);
				{
				setState(195);
				breakStatement();
				}
				break;
			case 7:
				enterOuterAlt(_localctx, 7);
				{
				setState(196);
				continueStatement();
				}
				break;
			case 8:
				enterOuterAlt(_localctx, 8);
				{
				setState(197);
				returnStatement();
				}
				break;
			case 9:
				enterOuterAlt(_localctx, 9);
				{
				setState(198);
				incDecStatement();
				}
				break;
			case 10:
				enterOuterAlt(_localctx, 10);
				{
				setState(199);
				block();
				}
				break;
			case 11:
				enterOuterAlt(_localctx, 11);
				{
				setState(200);
				expressionStatement();
				}
				break;
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class AssignmentContext extends ParserRuleContext {
		public AssignmentContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_assignment; }
	 
		public AssignmentContext() { }
		public void copyFrom(AssignmentContext ctx) {
			super.copyFrom(ctx);
		}
	}
	@SuppressWarnings("CheckReturnValue")
	public static class PointerAssignmentContext extends AssignmentContext {
		public TerminalNode ID() { return getToken(GolampiParser.ID, 0); }
		public AssignOpContext assignOp() {
			return getRuleContext(AssignOpContext.class,0);
		}
		public ExpressionContext expression() {
			return getRuleContext(ExpressionContext.class,0);
		}
		public PointerAssignmentContext(AssignmentContext ctx) { copyFrom(ctx); }
	}
	@SuppressWarnings("CheckReturnValue")
	public static class SimpleAssignmentContext extends AssignmentContext {
		public TerminalNode ID() { return getToken(GolampiParser.ID, 0); }
		public AssignOpContext assignOp() {
			return getRuleContext(AssignOpContext.class,0);
		}
		public ExpressionContext expression() {
			return getRuleContext(ExpressionContext.class,0);
		}
		public SimpleAssignmentContext(AssignmentContext ctx) { copyFrom(ctx); }
	}
	@SuppressWarnings("CheckReturnValue")
	public static class ArrayAssignmentContext extends AssignmentContext {
		public TerminalNode ID() { return getToken(GolampiParser.ID, 0); }
		public AssignOpContext assignOp() {
			return getRuleContext(AssignOpContext.class,0);
		}
		public List<ExpressionContext> expression() {
			return getRuleContexts(ExpressionContext.class);
		}
		public ExpressionContext expression(int i) {
			return getRuleContext(ExpressionContext.class,i);
		}
		public ArrayAssignmentContext(AssignmentContext ctx) { copyFrom(ctx); }
	}

	public final AssignmentContext assignment() throws RecognitionException {
		AssignmentContext _localctx = new AssignmentContext(_ctx, getState());
		enterRule(_localctx, 24, RULE_assignment);
		int _la;
		try {
			setState(224);
			_errHandler.sync(this);
			switch ( getInterpreter().adaptivePredict(_input,14,_ctx) ) {
			case 1:
				_localctx = new SimpleAssignmentContext(_localctx);
				enterOuterAlt(_localctx, 1);
				{
				setState(203);
				match(ID);
				setState(204);
				assignOp();
				setState(205);
				expression();
				}
				break;
			case 2:
				_localctx = new ArrayAssignmentContext(_localctx);
				enterOuterAlt(_localctx, 2);
				{
				setState(207);
				match(ID);
				setState(212); 
				_errHandler.sync(this);
				_la = _input.LA(1);
				do {
					{
					{
					setState(208);
					match(T__6);
					setState(209);
					expression();
					setState(210);
					match(T__7);
					}
					}
					setState(214); 
					_errHandler.sync(this);
					_la = _input.LA(1);
				} while ( _la==T__6 );
				setState(216);
				assignOp();
				setState(217);
				expression();
				}
				break;
			case 3:
				_localctx = new PointerAssignmentContext(_localctx);
				enterOuterAlt(_localctx, 3);
				{
				setState(219);
				match(T__5);
				setState(220);
				match(ID);
				setState(221);
				assignOp();
				setState(222);
				expression();
				}
				break;
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class AssignOpContext extends ParserRuleContext {
		public AssignOpContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_assignOp; }
	}

	public final AssignOpContext assignOp() throws RecognitionException {
		AssignOpContext _localctx = new AssignOpContext(_ctx, getState());
		enterRule(_localctx, 26, RULE_assignOp);
		int _la;
		try {
			enterOuterAlt(_localctx, 1);
			{
			setState(226);
			_la = _input.LA(1);
			if ( !((((_la) & ~0x3f) == 0 && ((1L << _la) & 7682L) != 0)) ) {
			_errHandler.recoverInline(this);
			}
			else {
				if ( _input.LA(1)==Token.EOF ) matchedEOF = true;
				_errHandler.reportMatch(this);
				consume();
			}
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class IncDecStatementContext extends ParserRuleContext {
		public IncDecStatementContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_incDecStatement; }
	 
		public IncDecStatementContext() { }
		public void copyFrom(IncDecStatementContext ctx) {
			super.copyFrom(ctx);
		}
	}
	@SuppressWarnings("CheckReturnValue")
	public static class DecrementStatementContext extends IncDecStatementContext {
		public TerminalNode ID() { return getToken(GolampiParser.ID, 0); }
		public DecrementStatementContext(IncDecStatementContext ctx) { copyFrom(ctx); }
	}
	@SuppressWarnings("CheckReturnValue")
	public static class IncrementStatementContext extends IncDecStatementContext {
		public TerminalNode ID() { return getToken(GolampiParser.ID, 0); }
		public IncrementStatementContext(IncDecStatementContext ctx) { copyFrom(ctx); }
	}

	public final IncDecStatementContext incDecStatement() throws RecognitionException {
		IncDecStatementContext _localctx = new IncDecStatementContext(_ctx, getState());
		enterRule(_localctx, 28, RULE_incDecStatement);
		try {
			setState(232);
			_errHandler.sync(this);
			switch ( getInterpreter().adaptivePredict(_input,15,_ctx) ) {
			case 1:
				_localctx = new IncrementStatementContext(_localctx);
				enterOuterAlt(_localctx, 1);
				{
				setState(228);
				match(ID);
				setState(229);
				match(T__12);
				}
				break;
			case 2:
				_localctx = new DecrementStatementContext(_localctx);
				enterOuterAlt(_localctx, 2);
				{
				setState(230);
				match(ID);
				setState(231);
				match(T__13);
				}
				break;
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class IfStatementContext extends ParserRuleContext {
		public IfStatementContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_ifStatement; }
	 
		public IfStatementContext() { }
		public void copyFrom(IfStatementContext ctx) {
			super.copyFrom(ctx);
		}
	}
	@SuppressWarnings("CheckReturnValue")
	public static class IfElseIfElseContext extends IfStatementContext {
		public List<TerminalNode> IF() { return getTokens(GolampiParser.IF); }
		public TerminalNode IF(int i) {
			return getToken(GolampiParser.IF, i);
		}
		public List<ExpressionContext> expression() {
			return getRuleContexts(ExpressionContext.class);
		}
		public ExpressionContext expression(int i) {
			return getRuleContext(ExpressionContext.class,i);
		}
		public List<BlockContext> block() {
			return getRuleContexts(BlockContext.class);
		}
		public BlockContext block(int i) {
			return getRuleContext(BlockContext.class,i);
		}
		public List<TerminalNode> ELSE() { return getTokens(GolampiParser.ELSE); }
		public TerminalNode ELSE(int i) {
			return getToken(GolampiParser.ELSE, i);
		}
		public IfElseIfElseContext(IfStatementContext ctx) { copyFrom(ctx); }
	}

	public final IfStatementContext ifStatement() throws RecognitionException {
		IfStatementContext _localctx = new IfStatementContext(_ctx, getState());
		enterRule(_localctx, 30, RULE_ifStatement);
		int _la;
		try {
			int _alt;
			_localctx = new IfElseIfElseContext(_localctx);
			enterOuterAlt(_localctx, 1);
			{
			setState(234);
			match(IF);
			setState(235);
			expression();
			setState(236);
			block();
			setState(244);
			_errHandler.sync(this);
			_alt = getInterpreter().adaptivePredict(_input,16,_ctx);
			while ( _alt!=2 && _alt!=org.antlr.v4.runtime.atn.ATN.INVALID_ALT_NUMBER ) {
				if ( _alt==1 ) {
					{
					{
					setState(237);
					match(ELSE);
					setState(238);
					match(IF);
					setState(239);
					expression();
					setState(240);
					block();
					}
					} 
				}
				setState(246);
				_errHandler.sync(this);
				_alt = getInterpreter().adaptivePredict(_input,16,_ctx);
			}
			setState(249);
			_errHandler.sync(this);
			_la = _input.LA(1);
			if (_la==ELSE) {
				{
				setState(247);
				match(ELSE);
				setState(248);
				block();
				}
			}

			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class SwitchStatementContext extends ParserRuleContext {
		public TerminalNode SWITCH() { return getToken(GolampiParser.SWITCH, 0); }
		public ExpressionContext expression() {
			return getRuleContext(ExpressionContext.class,0);
		}
		public List<CaseClauseContext> caseClause() {
			return getRuleContexts(CaseClauseContext.class);
		}
		public CaseClauseContext caseClause(int i) {
			return getRuleContext(CaseClauseContext.class,i);
		}
		public DefaultClauseContext defaultClause() {
			return getRuleContext(DefaultClauseContext.class,0);
		}
		public SwitchStatementContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_switchStatement; }
	}

	public final SwitchStatementContext switchStatement() throws RecognitionException {
		SwitchStatementContext _localctx = new SwitchStatementContext(_ctx, getState());
		enterRule(_localctx, 32, RULE_switchStatement);
		int _la;
		try {
			enterOuterAlt(_localctx, 1);
			{
			setState(251);
			match(SWITCH);
			setState(252);
			expression();
			setState(253);
			match(T__14);
			setState(257);
			_errHandler.sync(this);
			_la = _input.LA(1);
			while (_la==CASE) {
				{
				{
				setState(254);
				caseClause();
				}
				}
				setState(259);
				_errHandler.sync(this);
				_la = _input.LA(1);
			}
			setState(261);
			_errHandler.sync(this);
			_la = _input.LA(1);
			if (_la==DEFAULT) {
				{
				setState(260);
				defaultClause();
				}
			}

			setState(263);
			match(T__15);
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class CaseClauseContext extends ParserRuleContext {
		public TerminalNode CASE() { return getToken(GolampiParser.CASE, 0); }
		public CaseExpressionListContext caseExpressionList() {
			return getRuleContext(CaseExpressionListContext.class,0);
		}
		public List<StatementContext> statement() {
			return getRuleContexts(StatementContext.class);
		}
		public StatementContext statement(int i) {
			return getRuleContext(StatementContext.class,i);
		}
		public CaseClauseContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_caseClause; }
	}

	public final CaseClauseContext caseClause() throws RecognitionException {
		CaseClauseContext _localctx = new CaseClauseContext(_ctx, getState());
		enterRule(_localctx, 34, RULE_caseClause);
		int _la;
		try {
			enterOuterAlt(_localctx, 1);
			{
			setState(265);
			match(CASE);
			setState(266);
			caseExpressionList();
			setState(267);
			match(T__16);
			setState(271);
			_errHandler.sync(this);
			_la = _input.LA(1);
			while ((((_la) & ~0x3f) == 0 && ((1L << _la) & 35042708565295304L) != 0)) {
				{
				{
				setState(268);
				statement();
				}
				}
				setState(273);
				_errHandler.sync(this);
				_la = _input.LA(1);
			}
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class CaseExpressionListContext extends ParserRuleContext {
		public List<CaseExpressionContext> caseExpression() {
			return getRuleContexts(CaseExpressionContext.class);
		}
		public CaseExpressionContext caseExpression(int i) {
			return getRuleContext(CaseExpressionContext.class,i);
		}
		public CaseExpressionListContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_caseExpressionList; }
	}

	public final CaseExpressionListContext caseExpressionList() throws RecognitionException {
		CaseExpressionListContext _localctx = new CaseExpressionListContext(_ctx, getState());
		enterRule(_localctx, 36, RULE_caseExpressionList);
		int _la;
		try {
			enterOuterAlt(_localctx, 1);
			{
			setState(274);
			caseExpression();
			setState(279);
			_errHandler.sync(this);
			_la = _input.LA(1);
			while (_la==T__4) {
				{
				{
				setState(275);
				match(T__4);
				setState(276);
				caseExpression();
				}
				}
				setState(281);
				_errHandler.sync(this);
				_la = _input.LA(1);
			}
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class CaseExpressionContext extends ParserRuleContext {
		public CaseExpressionContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_caseExpression; }
	 
		public CaseExpressionContext() { }
		public void copyFrom(CaseExpressionContext ctx) {
			super.copyFrom(ctx);
		}
	}
	@SuppressWarnings("CheckReturnValue")
	public static class RangeCaseExprContext extends CaseExpressionContext {
		public List<ExpressionContext> expression() {
			return getRuleContexts(ExpressionContext.class);
		}
		public ExpressionContext expression(int i) {
			return getRuleContext(ExpressionContext.class,i);
		}
		public TerminalNode RANGE() { return getToken(GolampiParser.RANGE, 0); }
		public RangeCaseExprContext(CaseExpressionContext ctx) { copyFrom(ctx); }
	}
	@SuppressWarnings("CheckReturnValue")
	public static class SingleCaseExprContext extends CaseExpressionContext {
		public ExpressionContext expression() {
			return getRuleContext(ExpressionContext.class,0);
		}
		public SingleCaseExprContext(CaseExpressionContext ctx) { copyFrom(ctx); }
	}

	public final CaseExpressionContext caseExpression() throws RecognitionException {
		CaseExpressionContext _localctx = new CaseExpressionContext(_ctx, getState());
		enterRule(_localctx, 38, RULE_caseExpression);
		try {
			setState(287);
			_errHandler.sync(this);
			switch ( getInterpreter().adaptivePredict(_input,22,_ctx) ) {
			case 1:
				_localctx = new RangeCaseExprContext(_localctx);
				enterOuterAlt(_localctx, 1);
				{
				setState(282);
				expression();
				setState(283);
				match(RANGE);
				setState(284);
				expression();
				}
				break;
			case 2:
				_localctx = new SingleCaseExprContext(_localctx);
				enterOuterAlt(_localctx, 2);
				{
				setState(286);
				expression();
				}
				break;
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class DefaultClauseContext extends ParserRuleContext {
		public TerminalNode DEFAULT() { return getToken(GolampiParser.DEFAULT, 0); }
		public List<StatementContext> statement() {
			return getRuleContexts(StatementContext.class);
		}
		public StatementContext statement(int i) {
			return getRuleContext(StatementContext.class,i);
		}
		public DefaultClauseContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_defaultClause; }
	}

	public final DefaultClauseContext defaultClause() throws RecognitionException {
		DefaultClauseContext _localctx = new DefaultClauseContext(_ctx, getState());
		enterRule(_localctx, 40, RULE_defaultClause);
		int _la;
		try {
			enterOuterAlt(_localctx, 1);
			{
			setState(289);
			match(DEFAULT);
			setState(290);
			match(T__16);
			setState(294);
			_errHandler.sync(this);
			_la = _input.LA(1);
			while ((((_la) & ~0x3f) == 0 && ((1L << _la) & 35042708565295304L) != 0)) {
				{
				{
				setState(291);
				statement();
				}
				}
				setState(296);
				_errHandler.sync(this);
				_la = _input.LA(1);
			}
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class ForStatementContext extends ParserRuleContext {
		public ForStatementContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_forStatement; }
	 
		public ForStatementContext() { }
		public void copyFrom(ForStatementContext ctx) {
			super.copyFrom(ctx);
		}
	}
	@SuppressWarnings("CheckReturnValue")
	public static class ForTraditionalContext extends ForStatementContext {
		public TerminalNode FOR() { return getToken(GolampiParser.FOR, 0); }
		public ForClauseContext forClause() {
			return getRuleContext(ForClauseContext.class,0);
		}
		public BlockContext block() {
			return getRuleContext(BlockContext.class,0);
		}
		public ForTraditionalContext(ForStatementContext ctx) { copyFrom(ctx); }
	}
	@SuppressWarnings("CheckReturnValue")
	public static class ForWhileContext extends ForStatementContext {
		public TerminalNode FOR() { return getToken(GolampiParser.FOR, 0); }
		public ExpressionContext expression() {
			return getRuleContext(ExpressionContext.class,0);
		}
		public BlockContext block() {
			return getRuleContext(BlockContext.class,0);
		}
		public ForWhileContext(ForStatementContext ctx) { copyFrom(ctx); }
	}
	@SuppressWarnings("CheckReturnValue")
	public static class ForInfiniteContext extends ForStatementContext {
		public TerminalNode FOR() { return getToken(GolampiParser.FOR, 0); }
		public BlockContext block() {
			return getRuleContext(BlockContext.class,0);
		}
		public ForInfiniteContext(ForStatementContext ctx) { copyFrom(ctx); }
	}

	public final ForStatementContext forStatement() throws RecognitionException {
		ForStatementContext _localctx = new ForStatementContext(_ctx, getState());
		enterRule(_localctx, 42, RULE_forStatement);
		try {
			setState(307);
			_errHandler.sync(this);
			switch ( getInterpreter().adaptivePredict(_input,24,_ctx) ) {
			case 1:
				_localctx = new ForTraditionalContext(_localctx);
				enterOuterAlt(_localctx, 1);
				{
				setState(297);
				match(FOR);
				setState(298);
				forClause();
				setState(299);
				block();
				}
				break;
			case 2:
				_localctx = new ForWhileContext(_localctx);
				enterOuterAlt(_localctx, 2);
				{
				setState(301);
				match(FOR);
				setState(302);
				expression();
				setState(303);
				block();
				}
				break;
			case 3:
				_localctx = new ForInfiniteContext(_localctx);
				enterOuterAlt(_localctx, 3);
				{
				setState(305);
				match(FOR);
				setState(306);
				block();
				}
				break;
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class ForClauseContext extends ParserRuleContext {
		public ForInitContext forInit() {
			return getRuleContext(ForInitContext.class,0);
		}
		public ForPostContext forPost() {
			return getRuleContext(ForPostContext.class,0);
		}
		public ExpressionContext expression() {
			return getRuleContext(ExpressionContext.class,0);
		}
		public ForClauseContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_forClause; }
	}

	public final ForClauseContext forClause() throws RecognitionException {
		ForClauseContext _localctx = new ForClauseContext(_ctx, getState());
		enterRule(_localctx, 44, RULE_forClause);
		int _la;
		try {
			enterOuterAlt(_localctx, 1);
			{
			setState(309);
			forInit();
			setState(310);
			match(T__17);
			setState(312);
			_errHandler.sync(this);
			_la = _input.LA(1);
			if ((((_la) & ~0x3f) == 0 && ((1L << _la) & 35026044092186824L) != 0)) {
				{
				setState(311);
				expression();
				}
			}

			setState(314);
			match(T__17);
			setState(315);
			forPost();
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class ForInitContext extends ParserRuleContext {
		public VarDeclarationContext varDeclaration() {
			return getRuleContext(VarDeclarationContext.class,0);
		}
		public ShortVarDeclarationContext shortVarDeclaration() {
			return getRuleContext(ShortVarDeclarationContext.class,0);
		}
		public AssignmentContext assignment() {
			return getRuleContext(AssignmentContext.class,0);
		}
		public IncDecStatementContext incDecStatement() {
			return getRuleContext(IncDecStatementContext.class,0);
		}
		public ForInitContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_forInit; }
	}

	public final ForInitContext forInit() throws RecognitionException {
		ForInitContext _localctx = new ForInitContext(_ctx, getState());
		enterRule(_localctx, 46, RULE_forInit);
		try {
			setState(322);
			_errHandler.sync(this);
			switch ( getInterpreter().adaptivePredict(_input,26,_ctx) ) {
			case 1:
				enterOuterAlt(_localctx, 1);
				{
				setState(317);
				varDeclaration();
				}
				break;
			case 2:
				enterOuterAlt(_localctx, 2);
				{
				setState(318);
				shortVarDeclaration();
				}
				break;
			case 3:
				enterOuterAlt(_localctx, 3);
				{
				setState(319);
				assignment();
				}
				break;
			case 4:
				enterOuterAlt(_localctx, 4);
				{
				setState(320);
				incDecStatement();
				}
				break;
			case 5:
				enterOuterAlt(_localctx, 5);
				{
				}
				break;
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class ForPostContext extends ParserRuleContext {
		public AssignmentContext assignment() {
			return getRuleContext(AssignmentContext.class,0);
		}
		public IncDecStatementContext incDecStatement() {
			return getRuleContext(IncDecStatementContext.class,0);
		}
		public ForPostContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_forPost; }
	}

	public final ForPostContext forPost() throws RecognitionException {
		ForPostContext _localctx = new ForPostContext(_ctx, getState());
		enterRule(_localctx, 48, RULE_forPost);
		try {
			setState(327);
			_errHandler.sync(this);
			switch ( getInterpreter().adaptivePredict(_input,27,_ctx) ) {
			case 1:
				enterOuterAlt(_localctx, 1);
				{
				setState(324);
				assignment();
				}
				break;
			case 2:
				enterOuterAlt(_localctx, 2);
				{
				setState(325);
				incDecStatement();
				}
				break;
			case 3:
				enterOuterAlt(_localctx, 3);
				{
				}
				break;
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class BreakStatementContext extends ParserRuleContext {
		public TerminalNode BREAK() { return getToken(GolampiParser.BREAK, 0); }
		public BreakStatementContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_breakStatement; }
	}

	public final BreakStatementContext breakStatement() throws RecognitionException {
		BreakStatementContext _localctx = new BreakStatementContext(_ctx, getState());
		enterRule(_localctx, 50, RULE_breakStatement);
		try {
			enterOuterAlt(_localctx, 1);
			{
			setState(329);
			match(BREAK);
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class ContinueStatementContext extends ParserRuleContext {
		public TerminalNode CONTINUE() { return getToken(GolampiParser.CONTINUE, 0); }
		public ContinueStatementContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_continueStatement; }
	}

	public final ContinueStatementContext continueStatement() throws RecognitionException {
		ContinueStatementContext _localctx = new ContinueStatementContext(_ctx, getState());
		enterRule(_localctx, 52, RULE_continueStatement);
		try {
			enterOuterAlt(_localctx, 1);
			{
			setState(331);
			match(CONTINUE);
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class ReturnStatementContext extends ParserRuleContext {
		public TerminalNode RETURN() { return getToken(GolampiParser.RETURN, 0); }
		public ExpressionListContext expressionList() {
			return getRuleContext(ExpressionListContext.class,0);
		}
		public ReturnStatementContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_returnStatement; }
	}

	public final ReturnStatementContext returnStatement() throws RecognitionException {
		ReturnStatementContext _localctx = new ReturnStatementContext(_ctx, getState());
		enterRule(_localctx, 54, RULE_returnStatement);
		try {
			enterOuterAlt(_localctx, 1);
			{
			setState(333);
			match(RETURN);
			setState(335);
			_errHandler.sync(this);
			switch ( getInterpreter().adaptivePredict(_input,28,_ctx) ) {
			case 1:
				{
				setState(334);
				expressionList();
				}
				break;
			}
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class BlockContext extends ParserRuleContext {
		public List<DeclarationContext> declaration() {
			return getRuleContexts(DeclarationContext.class);
		}
		public DeclarationContext declaration(int i) {
			return getRuleContext(DeclarationContext.class,i);
		}
		public BlockContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_block; }
	}

	public final BlockContext block() throws RecognitionException {
		BlockContext _localctx = new BlockContext(_ctx, getState());
		enterRule(_localctx, 56, RULE_block);
		int _la;
		try {
			enterOuterAlt(_localctx, 1);
			{
			setState(337);
			match(T__14);
			setState(341);
			_errHandler.sync(this);
			_la = _input.LA(1);
			while ((((_la) & ~0x3f) == 0 && ((1L << _la) & 35042738630066376L) != 0)) {
				{
				{
				setState(338);
				declaration();
				}
				}
				setState(343);
				_errHandler.sync(this);
				_la = _input.LA(1);
			}
			setState(344);
			match(T__15);
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class ExpressionStatementContext extends ParserRuleContext {
		public ExpressionContext expression() {
			return getRuleContext(ExpressionContext.class,0);
		}
		public ExpressionStatementContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_expressionStatement; }
	}

	public final ExpressionStatementContext expressionStatement() throws RecognitionException {
		ExpressionStatementContext _localctx = new ExpressionStatementContext(_ctx, getState());
		enterRule(_localctx, 58, RULE_expressionStatement);
		try {
			enterOuterAlt(_localctx, 1);
			{
			setState(346);
			expression();
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class ExpressionContext extends ParserRuleContext {
		public LogicalOrContext logicalOr() {
			return getRuleContext(LogicalOrContext.class,0);
		}
		public ExpressionContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_expression; }
	}

	public final ExpressionContext expression() throws RecognitionException {
		ExpressionContext _localctx = new ExpressionContext(_ctx, getState());
		enterRule(_localctx, 60, RULE_expression);
		try {
			enterOuterAlt(_localctx, 1);
			{
			setState(348);
			logicalOr();
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class LogicalOrContext extends ParserRuleContext {
		public List<LogicalAndContext> logicalAnd() {
			return getRuleContexts(LogicalAndContext.class);
		}
		public LogicalAndContext logicalAnd(int i) {
			return getRuleContext(LogicalAndContext.class,i);
		}
		public List<TerminalNode> OR() { return getTokens(GolampiParser.OR); }
		public TerminalNode OR(int i) {
			return getToken(GolampiParser.OR, i);
		}
		public LogicalOrContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_logicalOr; }
	}

	public final LogicalOrContext logicalOr() throws RecognitionException {
		LogicalOrContext _localctx = new LogicalOrContext(_ctx, getState());
		enterRule(_localctx, 62, RULE_logicalOr);
		int _la;
		try {
			enterOuterAlt(_localctx, 1);
			{
			setState(350);
			logicalAnd();
			setState(355);
			_errHandler.sync(this);
			_la = _input.LA(1);
			while (_la==OR) {
				{
				{
				setState(351);
				match(OR);
				setState(352);
				logicalAnd();
				}
				}
				setState(357);
				_errHandler.sync(this);
				_la = _input.LA(1);
			}
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class LogicalAndContext extends ParserRuleContext {
		public List<EqualityContext> equality() {
			return getRuleContexts(EqualityContext.class);
		}
		public EqualityContext equality(int i) {
			return getRuleContext(EqualityContext.class,i);
		}
		public List<TerminalNode> AND() { return getTokens(GolampiParser.AND); }
		public TerminalNode AND(int i) {
			return getToken(GolampiParser.AND, i);
		}
		public LogicalAndContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_logicalAnd; }
	}

	public final LogicalAndContext logicalAnd() throws RecognitionException {
		LogicalAndContext _localctx = new LogicalAndContext(_ctx, getState());
		enterRule(_localctx, 64, RULE_logicalAnd);
		int _la;
		try {
			enterOuterAlt(_localctx, 1);
			{
			setState(358);
			equality();
			setState(363);
			_errHandler.sync(this);
			_la = _input.LA(1);
			while (_la==AND) {
				{
				{
				setState(359);
				match(AND);
				setState(360);
				equality();
				}
				}
				setState(365);
				_errHandler.sync(this);
				_la = _input.LA(1);
			}
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class EqualityContext extends ParserRuleContext {
		public List<RelationalContext> relational() {
			return getRuleContexts(RelationalContext.class);
		}
		public RelationalContext relational(int i) {
			return getRuleContext(RelationalContext.class,i);
		}
		public EqualityContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_equality; }
	}

	public final EqualityContext equality() throws RecognitionException {
		EqualityContext _localctx = new EqualityContext(_ctx, getState());
		enterRule(_localctx, 66, RULE_equality);
		int _la;
		try {
			enterOuterAlt(_localctx, 1);
			{
			setState(366);
			relational();
			setState(371);
			_errHandler.sync(this);
			_la = _input.LA(1);
			while (_la==T__18 || _la==T__19) {
				{
				{
				setState(367);
				_la = _input.LA(1);
				if ( !(_la==T__18 || _la==T__19) ) {
				_errHandler.recoverInline(this);
				}
				else {
					if ( _input.LA(1)==Token.EOF ) matchedEOF = true;
					_errHandler.reportMatch(this);
					consume();
				}
				setState(368);
				relational();
				}
				}
				setState(373);
				_errHandler.sync(this);
				_la = _input.LA(1);
			}
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class RelationalContext extends ParserRuleContext {
		public List<AdditiveContext> additive() {
			return getRuleContexts(AdditiveContext.class);
		}
		public AdditiveContext additive(int i) {
			return getRuleContext(AdditiveContext.class,i);
		}
		public RelationalContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_relational; }
	}

	public final RelationalContext relational() throws RecognitionException {
		RelationalContext _localctx = new RelationalContext(_ctx, getState());
		enterRule(_localctx, 68, RULE_relational);
		int _la;
		try {
			enterOuterAlt(_localctx, 1);
			{
			setState(374);
			additive();
			setState(379);
			_errHandler.sync(this);
			_la = _input.LA(1);
			while ((((_la) & ~0x3f) == 0 && ((1L << _la) & 31457280L) != 0)) {
				{
				{
				setState(375);
				_la = _input.LA(1);
				if ( !((((_la) & ~0x3f) == 0 && ((1L << _la) & 31457280L) != 0)) ) {
				_errHandler.recoverInline(this);
				}
				else {
					if ( _input.LA(1)==Token.EOF ) matchedEOF = true;
					_errHandler.reportMatch(this);
					consume();
				}
				setState(376);
				additive();
				}
				}
				setState(381);
				_errHandler.sync(this);
				_la = _input.LA(1);
			}
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class AdditiveContext extends ParserRuleContext {
		public List<MultiplicativeContext> multiplicative() {
			return getRuleContexts(MultiplicativeContext.class);
		}
		public MultiplicativeContext multiplicative(int i) {
			return getRuleContext(MultiplicativeContext.class,i);
		}
		public AdditiveContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_additive; }
	}

	public final AdditiveContext additive() throws RecognitionException {
		AdditiveContext _localctx = new AdditiveContext(_ctx, getState());
		enterRule(_localctx, 70, RULE_additive);
		int _la;
		try {
			int _alt;
			enterOuterAlt(_localctx, 1);
			{
			setState(382);
			multiplicative();
			setState(387);
			_errHandler.sync(this);
			_alt = getInterpreter().adaptivePredict(_input,34,_ctx);
			while ( _alt!=2 && _alt!=org.antlr.v4.runtime.atn.ATN.INVALID_ALT_NUMBER ) {
				if ( _alt==1 ) {
					{
					{
					setState(383);
					_la = _input.LA(1);
					if ( !(_la==T__24 || _la==T__25) ) {
					_errHandler.recoverInline(this);
					}
					else {
						if ( _input.LA(1)==Token.EOF ) matchedEOF = true;
						_errHandler.reportMatch(this);
						consume();
					}
					setState(384);
					multiplicative();
					}
					} 
				}
				setState(389);
				_errHandler.sync(this);
				_alt = getInterpreter().adaptivePredict(_input,34,_ctx);
			}
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class MultiplicativeContext extends ParserRuleContext {
		public List<UnaryContext> unary() {
			return getRuleContexts(UnaryContext.class);
		}
		public UnaryContext unary(int i) {
			return getRuleContext(UnaryContext.class,i);
		}
		public MultiplicativeContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_multiplicative; }
	}

	public final MultiplicativeContext multiplicative() throws RecognitionException {
		MultiplicativeContext _localctx = new MultiplicativeContext(_ctx, getState());
		enterRule(_localctx, 72, RULE_multiplicative);
		int _la;
		try {
			int _alt;
			enterOuterAlt(_localctx, 1);
			{
			setState(390);
			unary();
			setState(395);
			_errHandler.sync(this);
			_alt = getInterpreter().adaptivePredict(_input,35,_ctx);
			while ( _alt!=2 && _alt!=org.antlr.v4.runtime.atn.ATN.INVALID_ALT_NUMBER ) {
				if ( _alt==1 ) {
					{
					{
					setState(391);
					_la = _input.LA(1);
					if ( !((((_la) & ~0x3f) == 0 && ((1L << _la) & 402653248L) != 0)) ) {
					_errHandler.recoverInline(this);
					}
					else {
						if ( _input.LA(1)==Token.EOF ) matchedEOF = true;
						_errHandler.reportMatch(this);
						consume();
					}
					setState(392);
					unary();
					}
					} 
				}
				setState(397);
				_errHandler.sync(this);
				_alt = getInterpreter().adaptivePredict(_input,35,_ctx);
			}
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class UnaryContext extends ParserRuleContext {
		public UnaryContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_unary; }
	 
		public UnaryContext() { }
		public void copyFrom(UnaryContext ctx) {
			super.copyFrom(ctx);
		}
	}
	@SuppressWarnings("CheckReturnValue")
	public static class AddressOfContext extends UnaryContext {
		public TerminalNode ID() { return getToken(GolampiParser.ID, 0); }
		public AddressOfContext(UnaryContext ctx) { copyFrom(ctx); }
	}
	@SuppressWarnings("CheckReturnValue")
	public static class NegativeUnaryContext extends UnaryContext {
		public UnaryContext unary() {
			return getRuleContext(UnaryContext.class,0);
		}
		public NegativeUnaryContext(UnaryContext ctx) { copyFrom(ctx); }
	}
	@SuppressWarnings("CheckReturnValue")
	public static class NotUnaryContext extends UnaryContext {
		public UnaryContext unary() {
			return getRuleContext(UnaryContext.class,0);
		}
		public NotUnaryContext(UnaryContext ctx) { copyFrom(ctx); }
	}
	@SuppressWarnings("CheckReturnValue")
	public static class DereferenceContext extends UnaryContext {
		public UnaryContext unary() {
			return getRuleContext(UnaryContext.class,0);
		}
		public DereferenceContext(UnaryContext ctx) { copyFrom(ctx); }
	}
	@SuppressWarnings("CheckReturnValue")
	public static class PrimaryUnaryContext extends UnaryContext {
		public PrimaryContext primary() {
			return getRuleContext(PrimaryContext.class,0);
		}
		public PrimaryUnaryContext(UnaryContext ctx) { copyFrom(ctx); }
	}

	public final UnaryContext unary() throws RecognitionException {
		UnaryContext _localctx = new UnaryContext(_ctx, getState());
		enterRule(_localctx, 74, RULE_unary);
		try {
			setState(407);
			_errHandler.sync(this);
			switch (_input.LA(1)) {
			case T__2:
			case T__6:
			case T__14:
			case TRUE:
			case FALSE:
			case NIL:
			case INT32:
			case FLOAT32:
			case RUNE:
			case STRING:
			case ID:
				_localctx = new PrimaryUnaryContext(_localctx);
				enterOuterAlt(_localctx, 1);
				{
				setState(398);
				primary();
				}
				break;
			case T__25:
				_localctx = new NegativeUnaryContext(_localctx);
				enterOuterAlt(_localctx, 2);
				{
				setState(399);
				match(T__25);
				setState(400);
				unary();
				}
				break;
			case T__28:
				_localctx = new NotUnaryContext(_localctx);
				enterOuterAlt(_localctx, 3);
				{
				setState(401);
				match(T__28);
				setState(402);
				unary();
				}
				break;
			case T__29:
				_localctx = new AddressOfContext(_localctx);
				enterOuterAlt(_localctx, 4);
				{
				setState(403);
				match(T__29);
				setState(404);
				match(ID);
				}
				break;
			case T__5:
				_localctx = new DereferenceContext(_localctx);
				enterOuterAlt(_localctx, 5);
				{
				setState(405);
				match(T__5);
				setState(406);
				unary();
				}
				break;
			default:
				throw new NoViableAltException(this);
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class PrimaryContext extends ParserRuleContext {
		public PrimaryContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_primary; }
	 
		public PrimaryContext() { }
		public void copyFrom(PrimaryContext ctx) {
			super.copyFrom(ctx);
		}
	}
	@SuppressWarnings("CheckReturnValue")
	public static class FloatLiteralContext extends PrimaryContext {
		public TerminalNode FLOAT32() { return getToken(GolampiParser.FLOAT32, 0); }
		public FloatLiteralContext(PrimaryContext ctx) { copyFrom(ctx); }
	}
	@SuppressWarnings("CheckReturnValue")
	public static class GroupedExpressionContext extends PrimaryContext {
		public ExpressionContext expression() {
			return getRuleContext(ExpressionContext.class,0);
		}
		public GroupedExpressionContext(PrimaryContext ctx) { copyFrom(ctx); }
	}
	@SuppressWarnings("CheckReturnValue")
	public static class FalseLiteralContext extends PrimaryContext {
		public TerminalNode FALSE() { return getToken(GolampiParser.FALSE, 0); }
		public FalseLiteralContext(PrimaryContext ctx) { copyFrom(ctx); }
	}
	@SuppressWarnings("CheckReturnValue")
	public static class ArrayAccessContext extends PrimaryContext {
		public TerminalNode ID() { return getToken(GolampiParser.ID, 0); }
		public List<ExpressionContext> expression() {
			return getRuleContexts(ExpressionContext.class);
		}
		public ExpressionContext expression(int i) {
			return getRuleContext(ExpressionContext.class,i);
		}
		public ArrayAccessContext(PrimaryContext ctx) { copyFrom(ctx); }
	}
	@SuppressWarnings("CheckReturnValue")
	public static class IdentifierContext extends PrimaryContext {
		public TerminalNode ID() { return getToken(GolampiParser.ID, 0); }
		public IdentifierContext(PrimaryContext ctx) { copyFrom(ctx); }
	}
	@SuppressWarnings("CheckReturnValue")
	public static class StringLiteralContext extends PrimaryContext {
		public TerminalNode STRING() { return getToken(GolampiParser.STRING, 0); }
		public StringLiteralContext(PrimaryContext ctx) { copyFrom(ctx); }
	}
	@SuppressWarnings("CheckReturnValue")
	public static class TrueLiteralContext extends PrimaryContext {
		public TerminalNode TRUE() { return getToken(GolampiParser.TRUE, 0); }
		public TrueLiteralContext(PrimaryContext ctx) { copyFrom(ctx); }
	}
	@SuppressWarnings("CheckReturnValue")
	public static class InnerArrayLiteralContext extends PrimaryContext {
		public ExpressionListContext expressionList() {
			return getRuleContext(ExpressionListContext.class,0);
		}
		public InnerArrayLiteralContext(PrimaryContext ctx) { copyFrom(ctx); }
	}
	@SuppressWarnings("CheckReturnValue")
	public static class NilLiteralContext extends PrimaryContext {
		public TerminalNode NIL() { return getToken(GolampiParser.NIL, 0); }
		public NilLiteralContext(PrimaryContext ctx) { copyFrom(ctx); }
	}
	@SuppressWarnings("CheckReturnValue")
	public static class ArrayLiteralExprContext extends PrimaryContext {
		public ArrayLiteralContext arrayLiteral() {
			return getRuleContext(ArrayLiteralContext.class,0);
		}
		public ArrayLiteralExprContext(PrimaryContext ctx) { copyFrom(ctx); }
	}
	@SuppressWarnings("CheckReturnValue")
	public static class IntLiteralContext extends PrimaryContext {
		public TerminalNode INT32() { return getToken(GolampiParser.INT32, 0); }
		public IntLiteralContext(PrimaryContext ctx) { copyFrom(ctx); }
	}
	@SuppressWarnings("CheckReturnValue")
	public static class FunctionCallContext extends PrimaryContext {
		public List<TerminalNode> ID() { return getTokens(GolampiParser.ID); }
		public TerminalNode ID(int i) {
			return getToken(GolampiParser.ID, i);
		}
		public ArgumentListContext argumentList() {
			return getRuleContext(ArgumentListContext.class,0);
		}
		public FunctionCallContext(PrimaryContext ctx) { copyFrom(ctx); }
	}
	@SuppressWarnings("CheckReturnValue")
	public static class RuneLiteralContext extends PrimaryContext {
		public TerminalNode RUNE() { return getToken(GolampiParser.RUNE, 0); }
		public RuneLiteralContext(PrimaryContext ctx) { copyFrom(ctx); }
	}

	public final PrimaryContext primary() throws RecognitionException {
		PrimaryContext _localctx = new PrimaryContext(_ctx, getState());
		enterRule(_localctx, 76, RULE_primary);
		int _la;
		try {
			int _alt;
			setState(445);
			_errHandler.sync(this);
			switch ( getInterpreter().adaptivePredict(_input,40,_ctx) ) {
			case 1:
				_localctx = new IntLiteralContext(_localctx);
				enterOuterAlt(_localctx, 1);
				{
				setState(409);
				match(INT32);
				}
				break;
			case 2:
				_localctx = new FloatLiteralContext(_localctx);
				enterOuterAlt(_localctx, 2);
				{
				setState(410);
				match(FLOAT32);
				}
				break;
			case 3:
				_localctx = new RuneLiteralContext(_localctx);
				enterOuterAlt(_localctx, 3);
				{
				setState(411);
				match(RUNE);
				}
				break;
			case 4:
				_localctx = new StringLiteralContext(_localctx);
				enterOuterAlt(_localctx, 4);
				{
				setState(412);
				match(STRING);
				}
				break;
			case 5:
				_localctx = new TrueLiteralContext(_localctx);
				enterOuterAlt(_localctx, 5);
				{
				setState(413);
				match(TRUE);
				}
				break;
			case 6:
				_localctx = new FalseLiteralContext(_localctx);
				enterOuterAlt(_localctx, 6);
				{
				setState(414);
				match(FALSE);
				}
				break;
			case 7:
				_localctx = new NilLiteralContext(_localctx);
				enterOuterAlt(_localctx, 7);
				{
				setState(415);
				match(NIL);
				}
				break;
			case 8:
				_localctx = new FunctionCallContext(_localctx);
				enterOuterAlt(_localctx, 8);
				{
				setState(416);
				match(ID);
				setState(419);
				_errHandler.sync(this);
				_la = _input.LA(1);
				if (_la==T__30) {
					{
					setState(417);
					match(T__30);
					setState(418);
					match(ID);
					}
				}

				setState(421);
				match(T__2);
				setState(423);
				_errHandler.sync(this);
				_la = _input.LA(1);
				if ((((_la) & ~0x3f) == 0 && ((1L << _la) & 35026044092186824L) != 0)) {
					{
					setState(422);
					argumentList();
					}
				}

				setState(425);
				match(T__3);
				}
				break;
			case 9:
				_localctx = new ArrayAccessContext(_localctx);
				enterOuterAlt(_localctx, 9);
				{
				setState(426);
				match(ID);
				setState(431); 
				_errHandler.sync(this);
				_alt = 1;
				do {
					switch (_alt) {
					case 1:
						{
						{
						setState(427);
						match(T__6);
						setState(428);
						expression();
						setState(429);
						match(T__7);
						}
						}
						break;
					default:
						throw new NoViableAltException(this);
					}
					setState(433); 
					_errHandler.sync(this);
					_alt = getInterpreter().adaptivePredict(_input,39,_ctx);
				} while ( _alt!=2 && _alt!=org.antlr.v4.runtime.atn.ATN.INVALID_ALT_NUMBER );
				}
				break;
			case 10:
				_localctx = new IdentifierContext(_localctx);
				enterOuterAlt(_localctx, 10);
				{
				setState(435);
				match(ID);
				}
				break;
			case 11:
				_localctx = new GroupedExpressionContext(_localctx);
				enterOuterAlt(_localctx, 11);
				{
				setState(436);
				match(T__2);
				setState(437);
				expression();
				setState(438);
				match(T__3);
				}
				break;
			case 12:
				_localctx = new ArrayLiteralExprContext(_localctx);
				enterOuterAlt(_localctx, 12);
				{
				setState(440);
				arrayLiteral();
				}
				break;
			case 13:
				_localctx = new InnerArrayLiteralContext(_localctx);
				enterOuterAlt(_localctx, 13);
				{
				setState(441);
				match(T__14);
				setState(442);
				expressionList();
				setState(443);
				match(T__15);
				}
				break;
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class ArrayLiteralContext extends ParserRuleContext {
		public ArrayLiteralContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_arrayLiteral; }
	 
		public ArrayLiteralContext() { }
		public void copyFrom(ArrayLiteralContext ctx) {
			super.copyFrom(ctx);
		}
	}
	@SuppressWarnings("CheckReturnValue")
	public static class FixedArrayLiteralNodeContext extends ArrayLiteralContext {
		public ExpressionContext expression() {
			return getRuleContext(ExpressionContext.class,0);
		}
		public TypeContext type() {
			return getRuleContext(TypeContext.class,0);
		}
		public ExpressionListContext expressionList() {
			return getRuleContext(ExpressionListContext.class,0);
		}
		public InnerLiteralListContext innerLiteralList() {
			return getRuleContext(InnerLiteralListContext.class,0);
		}
		public FixedArrayLiteralNodeContext(ArrayLiteralContext ctx) { copyFrom(ctx); }
	}
	@SuppressWarnings("CheckReturnValue")
	public static class SliceLiteralNodeContext extends ArrayLiteralContext {
		public TypeContext type() {
			return getRuleContext(TypeContext.class,0);
		}
		public ExpressionListContext expressionList() {
			return getRuleContext(ExpressionListContext.class,0);
		}
		public SliceLiteralNodeContext(ArrayLiteralContext ctx) { copyFrom(ctx); }
	}

	public final ArrayLiteralContext arrayLiteral() throws RecognitionException {
		ArrayLiteralContext _localctx = new ArrayLiteralContext(_ctx, getState());
		enterRule(_localctx, 78, RULE_arrayLiteral);
		int _la;
		try {
			setState(467);
			_errHandler.sync(this);
			switch ( getInterpreter().adaptivePredict(_input,43,_ctx) ) {
			case 1:
				_localctx = new FixedArrayLiteralNodeContext(_localctx);
				enterOuterAlt(_localctx, 1);
				{
				setState(447);
				match(T__6);
				setState(448);
				expression();
				setState(449);
				match(T__7);
				setState(450);
				type();
				setState(451);
				match(T__14);
				setState(454);
				_errHandler.sync(this);
				switch ( getInterpreter().adaptivePredict(_input,41,_ctx) ) {
				case 1:
					{
					setState(452);
					expressionList();
					}
					break;
				case 2:
					{
					setState(453);
					innerLiteralList();
					}
					break;
				}
				setState(456);
				match(T__15);
				}
				break;
			case 2:
				_localctx = new SliceLiteralNodeContext(_localctx);
				enterOuterAlt(_localctx, 2);
				{
				setState(458);
				match(T__6);
				setState(459);
				match(T__7);
				setState(460);
				type();
				setState(461);
				match(T__14);
				setState(463);
				_errHandler.sync(this);
				_la = _input.LA(1);
				if ((((_la) & ~0x3f) == 0 && ((1L << _la) & 35026044092186824L) != 0)) {
					{
					setState(462);
					expressionList();
					}
				}

				setState(465);
				match(T__15);
				}
				break;
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class InnerLiteralListContext extends ParserRuleContext {
		public List<InnerLiteralContext> innerLiteral() {
			return getRuleContexts(InnerLiteralContext.class);
		}
		public InnerLiteralContext innerLiteral(int i) {
			return getRuleContext(InnerLiteralContext.class,i);
		}
		public InnerLiteralListContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_innerLiteralList; }
	}

	public final InnerLiteralListContext innerLiteralList() throws RecognitionException {
		InnerLiteralListContext _localctx = new InnerLiteralListContext(_ctx, getState());
		enterRule(_localctx, 80, RULE_innerLiteralList);
		int _la;
		try {
			int _alt;
			enterOuterAlt(_localctx, 1);
			{
			setState(469);
			innerLiteral();
			setState(474);
			_errHandler.sync(this);
			_alt = getInterpreter().adaptivePredict(_input,44,_ctx);
			while ( _alt!=2 && _alt!=org.antlr.v4.runtime.atn.ATN.INVALID_ALT_NUMBER ) {
				if ( _alt==1 ) {
					{
					{
					setState(470);
					match(T__4);
					setState(471);
					innerLiteral();
					}
					} 
				}
				setState(476);
				_errHandler.sync(this);
				_alt = getInterpreter().adaptivePredict(_input,44,_ctx);
			}
			setState(478);
			_errHandler.sync(this);
			_la = _input.LA(1);
			if (_la==T__4) {
				{
				setState(477);
				match(T__4);
				}
			}

			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class InnerLiteralContext extends ParserRuleContext {
		public ExpressionListContext expressionList() {
			return getRuleContext(ExpressionListContext.class,0);
		}
		public InnerLiteralContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_innerLiteral; }
	}

	public final InnerLiteralContext innerLiteral() throws RecognitionException {
		InnerLiteralContext _localctx = new InnerLiteralContext(_ctx, getState());
		enterRule(_localctx, 82, RULE_innerLiteral);
		int _la;
		try {
			enterOuterAlt(_localctx, 1);
			{
			setState(480);
			match(T__14);
			setState(481);
			expressionList();
			setState(483);
			_errHandler.sync(this);
			_la = _input.LA(1);
			if (_la==T__4) {
				{
				setState(482);
				match(T__4);
				}
			}

			setState(485);
			match(T__15);
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class ArgumentListContext extends ParserRuleContext {
		public List<ArgumentContext> argument() {
			return getRuleContexts(ArgumentContext.class);
		}
		public ArgumentContext argument(int i) {
			return getRuleContext(ArgumentContext.class,i);
		}
		public ArgumentListContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_argumentList; }
	}

	public final ArgumentListContext argumentList() throws RecognitionException {
		ArgumentListContext _localctx = new ArgumentListContext(_ctx, getState());
		enterRule(_localctx, 84, RULE_argumentList);
		int _la;
		try {
			enterOuterAlt(_localctx, 1);
			{
			setState(487);
			argument();
			setState(492);
			_errHandler.sync(this);
			_la = _input.LA(1);
			while (_la==T__4) {
				{
				{
				setState(488);
				match(T__4);
				setState(489);
				argument();
				}
				}
				setState(494);
				_errHandler.sync(this);
				_la = _input.LA(1);
			}
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class ArgumentContext extends ParserRuleContext {
		public ArgumentContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_argument; }
	 
		public ArgumentContext() { }
		public void copyFrom(ArgumentContext ctx) {
			super.copyFrom(ctx);
		}
	}
	@SuppressWarnings("CheckReturnValue")
	public static class AddressArgumentContext extends ArgumentContext {
		public TerminalNode ID() { return getToken(GolampiParser.ID, 0); }
		public AddressArgumentContext(ArgumentContext ctx) { copyFrom(ctx); }
	}
	@SuppressWarnings("CheckReturnValue")
	public static class ExpressionArgumentContext extends ArgumentContext {
		public ExpressionContext expression() {
			return getRuleContext(ExpressionContext.class,0);
		}
		public ExpressionArgumentContext(ArgumentContext ctx) { copyFrom(ctx); }
	}

	public final ArgumentContext argument() throws RecognitionException {
		ArgumentContext _localctx = new ArgumentContext(_ctx, getState());
		enterRule(_localctx, 86, RULE_argument);
		try {
			setState(498);
			_errHandler.sync(this);
			switch ( getInterpreter().adaptivePredict(_input,48,_ctx) ) {
			case 1:
				_localctx = new ExpressionArgumentContext(_localctx);
				enterOuterAlt(_localctx, 1);
				{
				setState(495);
				expression();
				}
				break;
			case 2:
				_localctx = new AddressArgumentContext(_localctx);
				enterOuterAlt(_localctx, 2);
				{
				setState(496);
				match(T__29);
				setState(497);
				match(ID);
				}
				break;
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class TypeContext extends ParserRuleContext {
		public TypeContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_type; }
	 
		public TypeContext() { }
		public void copyFrom(TypeContext ctx) {
			super.copyFrom(ctx);
		}
	}
	@SuppressWarnings("CheckReturnValue")
	public static class ArrayTypeContext extends TypeContext {
		public ExpressionContext expression() {
			return getRuleContext(ExpressionContext.class,0);
		}
		public TypeContext type() {
			return getRuleContext(TypeContext.class,0);
		}
		public ArrayTypeContext(TypeContext ctx) { copyFrom(ctx); }
	}
	@SuppressWarnings("CheckReturnValue")
	public static class BasicTypeContext extends TypeContext {
		public TerminalNode ID() { return getToken(GolampiParser.ID, 0); }
		public BasicTypeContext(TypeContext ctx) { copyFrom(ctx); }
	}
	@SuppressWarnings("CheckReturnValue")
	public static class SliceTypeContext extends TypeContext {
		public TypeContext type() {
			return getRuleContext(TypeContext.class,0);
		}
		public SliceTypeContext(TypeContext ctx) { copyFrom(ctx); }
	}
	@SuppressWarnings("CheckReturnValue")
	public static class PointerTypeContext extends TypeContext {
		public TypeContext type() {
			return getRuleContext(TypeContext.class,0);
		}
		public PointerTypeContext(TypeContext ctx) { copyFrom(ctx); }
	}

	public final TypeContext type() throws RecognitionException {
		TypeContext _localctx = new TypeContext(_ctx, getState());
		enterRule(_localctx, 88, RULE_type);
		try {
			setState(511);
			_errHandler.sync(this);
			switch ( getInterpreter().adaptivePredict(_input,49,_ctx) ) {
			case 1:
				_localctx = new BasicTypeContext(_localctx);
				enterOuterAlt(_localctx, 1);
				{
				setState(500);
				match(ID);
				}
				break;
			case 2:
				_localctx = new ArrayTypeContext(_localctx);
				enterOuterAlt(_localctx, 2);
				{
				setState(501);
				match(T__6);
				setState(502);
				expression();
				setState(503);
				match(T__7);
				setState(504);
				type();
				}
				break;
			case 3:
				_localctx = new SliceTypeContext(_localctx);
				enterOuterAlt(_localctx, 3);
				{
				setState(506);
				match(T__6);
				setState(507);
				match(T__7);
				setState(508);
				type();
				}
				break;
			case 4:
				_localctx = new PointerTypeContext(_localctx);
				enterOuterAlt(_localctx, 4);
				{
				setState(509);
				match(T__5);
				setState(510);
				type();
				}
				break;
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	public static final String _serializedATN =
		"\u0004\u00019\u0202\u0002\u0000\u0007\u0000\u0002\u0001\u0007\u0001\u0002"+
		"\u0002\u0007\u0002\u0002\u0003\u0007\u0003\u0002\u0004\u0007\u0004\u0002"+
		"\u0005\u0007\u0005\u0002\u0006\u0007\u0006\u0002\u0007\u0007\u0007\u0002"+
		"\b\u0007\b\u0002\t\u0007\t\u0002\n\u0007\n\u0002\u000b\u0007\u000b\u0002"+
		"\f\u0007\f\u0002\r\u0007\r\u0002\u000e\u0007\u000e\u0002\u000f\u0007\u000f"+
		"\u0002\u0010\u0007\u0010\u0002\u0011\u0007\u0011\u0002\u0012\u0007\u0012"+
		"\u0002\u0013\u0007\u0013\u0002\u0014\u0007\u0014\u0002\u0015\u0007\u0015"+
		"\u0002\u0016\u0007\u0016\u0002\u0017\u0007\u0017\u0002\u0018\u0007\u0018"+
		"\u0002\u0019\u0007\u0019\u0002\u001a\u0007\u001a\u0002\u001b\u0007\u001b"+
		"\u0002\u001c\u0007\u001c\u0002\u001d\u0007\u001d\u0002\u001e\u0007\u001e"+
		"\u0002\u001f\u0007\u001f\u0002 \u0007 \u0002!\u0007!\u0002\"\u0007\"\u0002"+
		"#\u0007#\u0002$\u0007$\u0002%\u0007%\u0002&\u0007&\u0002\'\u0007\'\u0002"+
		"(\u0007(\u0002)\u0007)\u0002*\u0007*\u0002+\u0007+\u0002,\u0007,\u0001"+
		"\u0000\u0005\u0000\\\b\u0000\n\u0000\f\u0000_\t\u0000\u0001\u0000\u0001"+
		"\u0000\u0001\u0001\u0001\u0001\u0001\u0001\u0001\u0001\u0003\u0001g\b"+
		"\u0001\u0001\u0002\u0001\u0002\u0001\u0002\u0001\u0002\u0001\u0002\u0001"+
		"\u0002\u0001\u0002\u0001\u0002\u0001\u0002\u0001\u0002\u0003\u0002s\b"+
		"\u0002\u0001\u0003\u0001\u0003\u0001\u0003\u0001\u0003\u0001\u0004\u0001"+
		"\u0004\u0001\u0004\u0001\u0004\u0001\u0004\u0001\u0004\u0001\u0005\u0001"+
		"\u0005\u0001\u0005\u0001\u0005\u0003\u0005\u0083\b\u0005\u0001\u0005\u0001"+
		"\u0005\u0003\u0005\u0087\b\u0005\u0001\u0005\u0001\u0005\u0001\u0005\u0001"+
		"\u0005\u0001\u0005\u0003\u0005\u008e\b\u0005\u0001\u0005\u0001\u0005\u0001"+
		"\u0005\u0001\u0005\u0001\u0005\u0001\u0005\u0003\u0005\u0096\b\u0005\u0001"+
		"\u0006\u0001\u0006\u0001\u0006\u0005\u0006\u009b\b\u0006\n\u0006\f\u0006"+
		"\u009e\t\u0006\u0001\u0007\u0001\u0007\u0001\u0007\u0001\u0007\u0001\u0007"+
		"\u0003\u0007\u00a5\b\u0007\u0001\b\u0001\b\u0001\b\u0005\b\u00aa\b\b\n"+
		"\b\f\b\u00ad\t\b\u0001\t\u0001\t\u0001\t\u0005\t\u00b2\b\t\n\t\f\t\u00b5"+
		"\t\t\u0001\n\u0001\n\u0001\n\u0005\n\u00ba\b\n\n\n\f\n\u00bd\t\n\u0001"+
		"\u000b\u0001\u000b\u0001\u000b\u0001\u000b\u0001\u000b\u0001\u000b\u0001"+
		"\u000b\u0001\u000b\u0001\u000b\u0001\u000b\u0001\u000b\u0003\u000b\u00ca"+
		"\b\u000b\u0001\f\u0001\f\u0001\f\u0001\f\u0001\f\u0001\f\u0001\f\u0001"+
		"\f\u0001\f\u0004\f\u00d5\b\f\u000b\f\f\f\u00d6\u0001\f\u0001\f\u0001\f"+
		"\u0001\f\u0001\f\u0001\f\u0001\f\u0001\f\u0003\f\u00e1\b\f\u0001\r\u0001"+
		"\r\u0001\u000e\u0001\u000e\u0001\u000e\u0001\u000e\u0003\u000e\u00e9\b"+
		"\u000e\u0001\u000f\u0001\u000f\u0001\u000f\u0001\u000f\u0001\u000f\u0001"+
		"\u000f\u0001\u000f\u0001\u000f\u0005\u000f\u00f3\b\u000f\n\u000f\f\u000f"+
		"\u00f6\t\u000f\u0001\u000f\u0001\u000f\u0003\u000f\u00fa\b\u000f\u0001"+
		"\u0010\u0001\u0010\u0001\u0010\u0001\u0010\u0005\u0010\u0100\b\u0010\n"+
		"\u0010\f\u0010\u0103\t\u0010\u0001\u0010\u0003\u0010\u0106\b\u0010\u0001"+
		"\u0010\u0001\u0010\u0001\u0011\u0001\u0011\u0001\u0011\u0001\u0011\u0005"+
		"\u0011\u010e\b\u0011\n\u0011\f\u0011\u0111\t\u0011\u0001\u0012\u0001\u0012"+
		"\u0001\u0012\u0005\u0012\u0116\b\u0012\n\u0012\f\u0012\u0119\t\u0012\u0001"+
		"\u0013\u0001\u0013\u0001\u0013\u0001\u0013\u0001\u0013\u0003\u0013\u0120"+
		"\b\u0013\u0001\u0014\u0001\u0014\u0001\u0014\u0005\u0014\u0125\b\u0014"+
		"\n\u0014\f\u0014\u0128\t\u0014\u0001\u0015\u0001\u0015\u0001\u0015\u0001"+
		"\u0015\u0001\u0015\u0001\u0015\u0001\u0015\u0001\u0015\u0001\u0015\u0001"+
		"\u0015\u0003\u0015\u0134\b\u0015\u0001\u0016\u0001\u0016\u0001\u0016\u0003"+
		"\u0016\u0139\b\u0016\u0001\u0016\u0001\u0016\u0001\u0016\u0001\u0017\u0001"+
		"\u0017\u0001\u0017\u0001\u0017\u0001\u0017\u0003\u0017\u0143\b\u0017\u0001"+
		"\u0018\u0001\u0018\u0001\u0018\u0003\u0018\u0148\b\u0018\u0001\u0019\u0001"+
		"\u0019\u0001\u001a\u0001\u001a\u0001\u001b\u0001\u001b\u0003\u001b\u0150"+
		"\b\u001b\u0001\u001c\u0001\u001c\u0005\u001c\u0154\b\u001c\n\u001c\f\u001c"+
		"\u0157\t\u001c\u0001\u001c\u0001\u001c\u0001\u001d\u0001\u001d\u0001\u001e"+
		"\u0001\u001e\u0001\u001f\u0001\u001f\u0001\u001f\u0005\u001f\u0162\b\u001f"+
		"\n\u001f\f\u001f\u0165\t\u001f\u0001 \u0001 \u0001 \u0005 \u016a\b \n"+
		" \f \u016d\t \u0001!\u0001!\u0001!\u0005!\u0172\b!\n!\f!\u0175\t!\u0001"+
		"\"\u0001\"\u0001\"\u0005\"\u017a\b\"\n\"\f\"\u017d\t\"\u0001#\u0001#\u0001"+
		"#\u0005#\u0182\b#\n#\f#\u0185\t#\u0001$\u0001$\u0001$\u0005$\u018a\b$"+
		"\n$\f$\u018d\t$\u0001%\u0001%\u0001%\u0001%\u0001%\u0001%\u0001%\u0001"+
		"%\u0001%\u0003%\u0198\b%\u0001&\u0001&\u0001&\u0001&\u0001&\u0001&\u0001"+
		"&\u0001&\u0001&\u0001&\u0003&\u01a4\b&\u0001&\u0001&\u0003&\u01a8\b&\u0001"+
		"&\u0001&\u0001&\u0001&\u0001&\u0001&\u0004&\u01b0\b&\u000b&\f&\u01b1\u0001"+
		"&\u0001&\u0001&\u0001&\u0001&\u0001&\u0001&\u0001&\u0001&\u0001&\u0003"+
		"&\u01be\b&\u0001\'\u0001\'\u0001\'\u0001\'\u0001\'\u0001\'\u0001\'\u0003"+
		"\'\u01c7\b\'\u0001\'\u0001\'\u0001\'\u0001\'\u0001\'\u0001\'\u0001\'\u0003"+
		"\'\u01d0\b\'\u0001\'\u0001\'\u0003\'\u01d4\b\'\u0001(\u0001(\u0001(\u0005"+
		"(\u01d9\b(\n(\f(\u01dc\t(\u0001(\u0003(\u01df\b(\u0001)\u0001)\u0001)"+
		"\u0003)\u01e4\b)\u0001)\u0001)\u0001*\u0001*\u0001*\u0005*\u01eb\b*\n"+
		"*\f*\u01ee\t*\u0001+\u0001+\u0001+\u0003+\u01f3\b+\u0001,\u0001,\u0001"+
		",\u0001,\u0001,\u0001,\u0001,\u0001,\u0001,\u0001,\u0001,\u0003,\u0200"+
		"\b,\u0001,\u0000\u0000-\u0000\u0002\u0004\u0006\b\n\f\u000e\u0010\u0012"+
		"\u0014\u0016\u0018\u001a\u001c\u001e \"$&(*,.02468:<>@BDFHJLNPRTVX\u0000"+
		"\u0005\u0002\u0000\u0001\u0001\t\f\u0001\u0000\u0013\u0014\u0001\u0000"+
		"\u0015\u0018\u0001\u0000\u0019\u001a\u0002\u0000\u0006\u0006\u001b\u001c"+
		"\u0228\u0000]\u0001\u0000\u0000\u0000\u0002f\u0001\u0000\u0000\u0000\u0004"+
		"r\u0001\u0000\u0000\u0000\u0006t\u0001\u0000\u0000\u0000\bx\u0001\u0000"+
		"\u0000\u0000\n\u0095\u0001\u0000\u0000\u0000\f\u0097\u0001\u0000\u0000"+
		"\u0000\u000e\u00a4\u0001\u0000\u0000\u0000\u0010\u00a6\u0001\u0000\u0000"+
		"\u0000\u0012\u00ae\u0001\u0000\u0000\u0000\u0014\u00b6\u0001\u0000\u0000"+
		"\u0000\u0016\u00c9\u0001\u0000\u0000\u0000\u0018\u00e0\u0001\u0000\u0000"+
		"\u0000\u001a\u00e2\u0001\u0000\u0000\u0000\u001c\u00e8\u0001\u0000\u0000"+
		"\u0000\u001e\u00ea\u0001\u0000\u0000\u0000 \u00fb\u0001\u0000\u0000\u0000"+
		"\"\u0109\u0001\u0000\u0000\u0000$\u0112\u0001\u0000\u0000\u0000&\u011f"+
		"\u0001\u0000\u0000\u0000(\u0121\u0001\u0000\u0000\u0000*\u0133\u0001\u0000"+
		"\u0000\u0000,\u0135\u0001\u0000\u0000\u0000.\u0142\u0001\u0000\u0000\u0000"+
		"0\u0147\u0001\u0000\u0000\u00002\u0149\u0001\u0000\u0000\u00004\u014b"+
		"\u0001\u0000\u0000\u00006\u014d\u0001\u0000\u0000\u00008\u0151\u0001\u0000"+
		"\u0000\u0000:\u015a\u0001\u0000\u0000\u0000<\u015c\u0001\u0000\u0000\u0000"+
		">\u015e\u0001\u0000\u0000\u0000@\u0166\u0001\u0000\u0000\u0000B\u016e"+
		"\u0001\u0000\u0000\u0000D\u0176\u0001\u0000\u0000\u0000F\u017e\u0001\u0000"+
		"\u0000\u0000H\u0186\u0001\u0000\u0000\u0000J\u0197\u0001\u0000\u0000\u0000"+
		"L\u01bd\u0001\u0000\u0000\u0000N\u01d3\u0001\u0000\u0000\u0000P\u01d5"+
		"\u0001\u0000\u0000\u0000R\u01e0\u0001\u0000\u0000\u0000T\u01e7\u0001\u0000"+
		"\u0000\u0000V\u01f2\u0001\u0000\u0000\u0000X\u01ff\u0001\u0000\u0000\u0000"+
		"Z\\\u0003\u0002\u0001\u0000[Z\u0001\u0000\u0000\u0000\\_\u0001\u0000\u0000"+
		"\u0000][\u0001\u0000\u0000\u0000]^\u0001\u0000\u0000\u0000^`\u0001\u0000"+
		"\u0000\u0000_]\u0001\u0000\u0000\u0000`a\u0005\u0000\u0000\u0001a\u0001"+
		"\u0001\u0000\u0000\u0000bg\u0003\u0004\u0002\u0000cg\u0003\b\u0004\u0000"+
		"dg\u0003\n\u0005\u0000eg\u0003\u0016\u000b\u0000fb\u0001\u0000\u0000\u0000"+
		"fc\u0001\u0000\u0000\u0000fd\u0001\u0000\u0000\u0000fe\u0001\u0000\u0000"+
		"\u0000g\u0003\u0001\u0000\u0000\u0000hi\u0005 \u0000\u0000ij\u0003\u0012"+
		"\t\u0000jk\u0003X,\u0000ks\u0001\u0000\u0000\u0000lm\u0005 \u0000\u0000"+
		"mn\u0003\u0012\t\u0000no\u0003X,\u0000op\u0005\u0001\u0000\u0000pq\u0003"+
		"\u0014\n\u0000qs\u0001\u0000\u0000\u0000rh\u0001\u0000\u0000\u0000rl\u0001"+
		"\u0000\u0000\u0000s\u0005\u0001\u0000\u0000\u0000tu\u0003\u0012\t\u0000"+
		"uv\u0005\u0002\u0000\u0000vw\u0003\u0014\n\u0000w\u0007\u0001\u0000\u0000"+
		"\u0000xy\u0005!\u0000\u0000yz\u00056\u0000\u0000z{\u0003X,\u0000{|\u0005"+
		"\u0001\u0000\u0000|}\u0003<\u001e\u0000}\t\u0001\u0000\u0000\u0000~\u007f"+
		"\u0005\"\u0000\u0000\u007f\u0080\u00056\u0000\u0000\u0080\u0082\u0005"+
		"\u0003\u0000\u0000\u0081\u0083\u0003\f\u0006\u0000\u0082\u0081\u0001\u0000"+
		"\u0000\u0000\u0082\u0083\u0001\u0000\u0000\u0000\u0083\u0084\u0001\u0000"+
		"\u0000\u0000\u0084\u0086\u0005\u0004\u0000\u0000\u0085\u0087\u0003X,\u0000"+
		"\u0086\u0085\u0001\u0000\u0000\u0000\u0086\u0087\u0001\u0000\u0000\u0000"+
		"\u0087\u0088\u0001\u0000\u0000\u0000\u0088\u0096\u00038\u001c\u0000\u0089"+
		"\u008a\u0005\"\u0000\u0000\u008a\u008b\u00056\u0000\u0000\u008b\u008d"+
		"\u0005\u0003\u0000\u0000\u008c\u008e\u0003\f\u0006\u0000\u008d\u008c\u0001"+
		"\u0000\u0000\u0000\u008d\u008e\u0001\u0000\u0000\u0000\u008e\u008f\u0001"+
		"\u0000\u0000\u0000\u008f\u0090\u0005\u0004\u0000\u0000\u0090\u0091\u0005"+
		"\u0003\u0000\u0000\u0091\u0092\u0003\u0010\b\u0000\u0092\u0093\u0005\u0004"+
		"\u0000\u0000\u0093\u0094\u00038\u001c\u0000\u0094\u0096\u0001\u0000\u0000"+
		"\u0000\u0095~\u0001\u0000\u0000\u0000\u0095\u0089\u0001\u0000\u0000\u0000"+
		"\u0096\u000b\u0001\u0000\u0000\u0000\u0097\u009c\u0003\u000e\u0007\u0000"+
		"\u0098\u0099\u0005\u0005\u0000\u0000\u0099\u009b\u0003\u000e\u0007\u0000"+
		"\u009a\u0098\u0001\u0000\u0000\u0000\u009b\u009e\u0001\u0000\u0000\u0000"+
		"\u009c\u009a\u0001\u0000\u0000\u0000\u009c\u009d\u0001\u0000\u0000\u0000"+
		"\u009d\r\u0001\u0000\u0000\u0000\u009e\u009c\u0001\u0000\u0000\u0000\u009f"+
		"\u00a0\u00056\u0000\u0000\u00a0\u00a5\u0003X,\u0000\u00a1\u00a2\u0005"+
		"\u0006\u0000\u0000\u00a2\u00a3\u00056\u0000\u0000\u00a3\u00a5\u0003X,"+
		"\u0000\u00a4\u009f\u0001\u0000\u0000\u0000\u00a4\u00a1\u0001\u0000\u0000"+
		"\u0000\u00a5\u000f\u0001\u0000\u0000\u0000\u00a6\u00ab\u0003X,\u0000\u00a7"+
		"\u00a8\u0005\u0005\u0000\u0000\u00a8\u00aa\u0003X,\u0000\u00a9\u00a7\u0001"+
		"\u0000\u0000\u0000\u00aa\u00ad\u0001\u0000\u0000\u0000\u00ab\u00a9\u0001"+
		"\u0000\u0000\u0000\u00ab\u00ac\u0001\u0000\u0000\u0000\u00ac\u0011\u0001"+
		"\u0000\u0000\u0000\u00ad\u00ab\u0001\u0000\u0000\u0000\u00ae\u00b3\u0005"+
		"6\u0000\u0000\u00af\u00b0\u0005\u0005\u0000\u0000\u00b0\u00b2\u00056\u0000"+
		"\u0000\u00b1\u00af\u0001\u0000\u0000\u0000\u00b2\u00b5\u0001\u0000\u0000"+
		"\u0000\u00b3\u00b1\u0001\u0000\u0000\u0000\u00b3\u00b4\u0001\u0000\u0000"+
		"\u0000\u00b4\u0013\u0001\u0000\u0000\u0000\u00b5\u00b3\u0001\u0000\u0000"+
		"\u0000\u00b6\u00bb\u0003<\u001e\u0000\u00b7\u00b8\u0005\u0005\u0000\u0000"+
		"\u00b8\u00ba\u0003<\u001e\u0000\u00b9\u00b7\u0001\u0000\u0000\u0000\u00ba"+
		"\u00bd\u0001\u0000\u0000\u0000\u00bb\u00b9\u0001\u0000\u0000\u0000\u00bb"+
		"\u00bc\u0001\u0000\u0000\u0000\u00bc\u0015\u0001\u0000\u0000\u0000\u00bd"+
		"\u00bb\u0001\u0000\u0000\u0000\u00be\u00ca\u0003\u0006\u0003\u0000\u00bf"+
		"\u00ca\u0003\u0018\f\u0000\u00c0\u00ca\u0003\u001e\u000f\u0000\u00c1\u00ca"+
		"\u0003 \u0010\u0000\u00c2\u00ca\u0003*\u0015\u0000\u00c3\u00ca\u00032"+
		"\u0019\u0000\u00c4\u00ca\u00034\u001a\u0000\u00c5\u00ca\u00036\u001b\u0000"+
		"\u00c6\u00ca\u0003\u001c\u000e\u0000\u00c7\u00ca\u00038\u001c\u0000\u00c8"+
		"\u00ca\u0003:\u001d\u0000\u00c9\u00be\u0001\u0000\u0000\u0000\u00c9\u00bf"+
		"\u0001\u0000\u0000\u0000\u00c9\u00c0\u0001\u0000\u0000\u0000\u00c9\u00c1"+
		"\u0001\u0000\u0000\u0000\u00c9\u00c2\u0001\u0000\u0000\u0000\u00c9\u00c3"+
		"\u0001\u0000\u0000\u0000\u00c9\u00c4\u0001\u0000\u0000\u0000\u00c9\u00c5"+
		"\u0001\u0000\u0000\u0000\u00c9\u00c6\u0001\u0000\u0000\u0000\u00c9\u00c7"+
		"\u0001\u0000\u0000\u0000\u00c9\u00c8\u0001\u0000\u0000\u0000\u00ca\u0017"+
		"\u0001\u0000\u0000\u0000\u00cb\u00cc\u00056\u0000\u0000\u00cc\u00cd\u0003"+
		"\u001a\r\u0000\u00cd\u00ce\u0003<\u001e\u0000\u00ce\u00e1\u0001\u0000"+
		"\u0000\u0000\u00cf\u00d4\u00056\u0000\u0000\u00d0\u00d1\u0005\u0007\u0000"+
		"\u0000\u00d1\u00d2\u0003<\u001e\u0000\u00d2\u00d3\u0005\b\u0000\u0000"+
		"\u00d3\u00d5\u0001\u0000\u0000\u0000\u00d4\u00d0\u0001\u0000\u0000\u0000"+
		"\u00d5\u00d6\u0001\u0000\u0000\u0000\u00d6\u00d4\u0001\u0000\u0000\u0000"+
		"\u00d6\u00d7\u0001\u0000\u0000\u0000\u00d7\u00d8\u0001\u0000\u0000\u0000"+
		"\u00d8\u00d9\u0003\u001a\r\u0000\u00d9\u00da\u0003<\u001e\u0000\u00da"+
		"\u00e1\u0001\u0000\u0000\u0000\u00db\u00dc\u0005\u0006\u0000\u0000\u00dc"+
		"\u00dd\u00056\u0000\u0000\u00dd\u00de\u0003\u001a\r\u0000\u00de\u00df"+
		"\u0003<\u001e\u0000\u00df\u00e1\u0001\u0000\u0000\u0000\u00e0\u00cb\u0001"+
		"\u0000\u0000\u0000\u00e0\u00cf\u0001\u0000\u0000\u0000\u00e0\u00db\u0001"+
		"\u0000\u0000\u0000\u00e1\u0019\u0001\u0000\u0000\u0000\u00e2\u00e3\u0007"+
		"\u0000\u0000\u0000\u00e3\u001b\u0001\u0000\u0000\u0000\u00e4\u00e5\u0005"+
		"6\u0000\u0000\u00e5\u00e9\u0005\r\u0000\u0000\u00e6\u00e7\u00056\u0000"+
		"\u0000\u00e7\u00e9\u0005\u000e\u0000\u0000\u00e8\u00e4\u0001\u0000\u0000"+
		"\u0000\u00e8\u00e6\u0001\u0000\u0000\u0000\u00e9\u001d\u0001\u0000\u0000"+
		"\u0000\u00ea\u00eb\u0005#\u0000\u0000\u00eb\u00ec\u0003<\u001e\u0000\u00ec"+
		"\u00f4\u00038\u001c\u0000\u00ed\u00ee\u0005$\u0000\u0000\u00ee\u00ef\u0005"+
		"#\u0000\u0000\u00ef\u00f0\u0003<\u001e\u0000\u00f0\u00f1\u00038\u001c"+
		"\u0000\u00f1\u00f3\u0001\u0000\u0000\u0000\u00f2\u00ed\u0001\u0000\u0000"+
		"\u0000\u00f3\u00f6\u0001\u0000\u0000\u0000\u00f4\u00f2\u0001\u0000\u0000"+
		"\u0000\u00f4\u00f5\u0001\u0000\u0000\u0000\u00f5\u00f9\u0001\u0000\u0000"+
		"\u0000\u00f6\u00f4\u0001\u0000\u0000\u0000\u00f7\u00f8\u0005$\u0000\u0000"+
		"\u00f8\u00fa\u00038\u001c\u0000\u00f9\u00f7\u0001\u0000\u0000\u0000\u00f9"+
		"\u00fa\u0001\u0000\u0000\u0000\u00fa\u001f\u0001\u0000\u0000\u0000\u00fb"+
		"\u00fc\u0005%\u0000\u0000\u00fc\u00fd\u0003<\u001e\u0000\u00fd\u0101\u0005"+
		"\u000f\u0000\u0000\u00fe\u0100\u0003\"\u0011\u0000\u00ff\u00fe\u0001\u0000"+
		"\u0000\u0000\u0100\u0103\u0001\u0000\u0000\u0000\u0101\u00ff\u0001\u0000"+
		"\u0000\u0000\u0101\u0102\u0001\u0000\u0000\u0000\u0102\u0105\u0001\u0000"+
		"\u0000\u0000\u0103\u0101\u0001\u0000\u0000\u0000\u0104\u0106\u0003(\u0014"+
		"\u0000\u0105\u0104\u0001\u0000\u0000\u0000\u0105\u0106\u0001\u0000\u0000"+
		"\u0000\u0106\u0107\u0001\u0000\u0000\u0000\u0107\u0108\u0005\u0010\u0000"+
		"\u0000\u0108!\u0001\u0000\u0000\u0000\u0109\u010a\u0005&\u0000\u0000\u010a"+
		"\u010b\u0003$\u0012\u0000\u010b\u010f\u0005\u0011\u0000\u0000\u010c\u010e"+
		"\u0003\u0016\u000b\u0000\u010d\u010c\u0001\u0000\u0000\u0000\u010e\u0111"+
		"\u0001\u0000\u0000\u0000\u010f\u010d\u0001\u0000\u0000\u0000\u010f\u0110"+
		"\u0001\u0000\u0000\u0000\u0110#\u0001\u0000\u0000\u0000\u0111\u010f\u0001"+
		"\u0000\u0000\u0000\u0112\u0117\u0003&\u0013\u0000\u0113\u0114\u0005\u0005"+
		"\u0000\u0000\u0114\u0116\u0003&\u0013\u0000\u0115\u0113\u0001\u0000\u0000"+
		"\u0000\u0116\u0119\u0001\u0000\u0000\u0000\u0117\u0115\u0001\u0000\u0000"+
		"\u0000\u0117\u0118\u0001\u0000\u0000\u0000\u0118%\u0001\u0000\u0000\u0000"+
		"\u0119\u0117\u0001\u0000\u0000\u0000\u011a\u011b\u0003<\u001e\u0000\u011b"+
		"\u011c\u00051\u0000\u0000\u011c\u011d\u0003<\u001e\u0000\u011d\u0120\u0001"+
		"\u0000\u0000\u0000\u011e\u0120\u0003<\u001e\u0000\u011f\u011a\u0001\u0000"+
		"\u0000\u0000\u011f\u011e\u0001\u0000\u0000\u0000\u0120\'\u0001\u0000\u0000"+
		"\u0000\u0121\u0122\u0005\'\u0000\u0000\u0122\u0126\u0005\u0011\u0000\u0000"+
		"\u0123\u0125\u0003\u0016\u000b\u0000\u0124\u0123\u0001\u0000\u0000\u0000"+
		"\u0125\u0128\u0001\u0000\u0000\u0000\u0126\u0124\u0001\u0000\u0000\u0000"+
		"\u0126\u0127\u0001\u0000\u0000\u0000\u0127)\u0001\u0000\u0000\u0000\u0128"+
		"\u0126\u0001\u0000\u0000\u0000\u0129\u012a\u0005(\u0000\u0000\u012a\u012b"+
		"\u0003,\u0016\u0000\u012b\u012c\u00038\u001c\u0000\u012c\u0134\u0001\u0000"+
		"\u0000\u0000\u012d\u012e\u0005(\u0000\u0000\u012e\u012f\u0003<\u001e\u0000"+
		"\u012f\u0130\u00038\u001c\u0000\u0130\u0134\u0001\u0000\u0000\u0000\u0131"+
		"\u0132\u0005(\u0000\u0000\u0132\u0134\u00038\u001c\u0000\u0133\u0129\u0001"+
		"\u0000\u0000\u0000\u0133\u012d\u0001\u0000\u0000\u0000\u0133\u0131\u0001"+
		"\u0000\u0000\u0000\u0134+\u0001\u0000\u0000\u0000\u0135\u0136\u0003.\u0017"+
		"\u0000\u0136\u0138\u0005\u0012\u0000\u0000\u0137\u0139\u0003<\u001e\u0000"+
		"\u0138\u0137\u0001\u0000\u0000\u0000\u0138\u0139\u0001\u0000\u0000\u0000"+
		"\u0139\u013a\u0001\u0000\u0000\u0000\u013a\u013b\u0005\u0012\u0000\u0000"+
		"\u013b\u013c\u00030\u0018\u0000\u013c-\u0001\u0000\u0000\u0000\u013d\u0143"+
		"\u0003\u0004\u0002\u0000\u013e\u0143\u0003\u0006\u0003\u0000\u013f\u0143"+
		"\u0003\u0018\f\u0000\u0140\u0143\u0003\u001c\u000e\u0000\u0141\u0143\u0001"+
		"\u0000\u0000\u0000\u0142\u013d\u0001\u0000\u0000\u0000\u0142\u013e\u0001"+
		"\u0000\u0000\u0000\u0142\u013f\u0001\u0000\u0000\u0000\u0142\u0140\u0001"+
		"\u0000\u0000\u0000\u0142\u0141\u0001\u0000\u0000\u0000\u0143/\u0001\u0000"+
		"\u0000\u0000\u0144\u0148\u0003\u0018\f\u0000\u0145\u0148\u0003\u001c\u000e"+
		"\u0000\u0146\u0148\u0001\u0000\u0000\u0000\u0147\u0144\u0001\u0000\u0000"+
		"\u0000\u0147\u0145\u0001\u0000\u0000\u0000\u0147\u0146\u0001\u0000\u0000"+
		"\u0000\u01481\u0001\u0000\u0000\u0000\u0149\u014a\u0005)\u0000\u0000\u014a"+
		"3\u0001\u0000\u0000\u0000\u014b\u014c\u0005*\u0000\u0000\u014c5\u0001"+
		"\u0000\u0000\u0000\u014d\u014f\u0005+\u0000\u0000\u014e\u0150\u0003\u0014"+
		"\n\u0000\u014f\u014e\u0001\u0000\u0000\u0000\u014f\u0150\u0001\u0000\u0000"+
		"\u0000\u01507\u0001\u0000\u0000\u0000\u0151\u0155\u0005\u000f\u0000\u0000"+
		"\u0152\u0154\u0003\u0002\u0001\u0000\u0153\u0152\u0001\u0000\u0000\u0000"+
		"\u0154\u0157\u0001\u0000\u0000\u0000\u0155\u0153\u0001\u0000\u0000\u0000"+
		"\u0155\u0156\u0001\u0000\u0000\u0000\u0156\u0158\u0001\u0000\u0000\u0000"+
		"\u0157\u0155\u0001\u0000\u0000\u0000\u0158\u0159\u0005\u0010\u0000\u0000"+
		"\u01599\u0001\u0000\u0000\u0000\u015a\u015b\u0003<\u001e\u0000\u015b;"+
		"\u0001\u0000\u0000\u0000\u015c\u015d\u0003>\u001f\u0000\u015d=\u0001\u0000"+
		"\u0000\u0000\u015e\u0163\u0003@ \u0000\u015f\u0160\u00050\u0000\u0000"+
		"\u0160\u0162\u0003@ \u0000\u0161\u015f\u0001\u0000\u0000\u0000\u0162\u0165"+
		"\u0001\u0000\u0000\u0000\u0163\u0161\u0001\u0000\u0000\u0000\u0163\u0164"+
		"\u0001\u0000\u0000\u0000\u0164?\u0001\u0000\u0000\u0000\u0165\u0163\u0001"+
		"\u0000\u0000\u0000\u0166\u016b\u0003B!\u0000\u0167\u0168\u0005/\u0000"+
		"\u0000\u0168\u016a\u0003B!\u0000\u0169\u0167\u0001\u0000\u0000\u0000\u016a"+
		"\u016d\u0001\u0000\u0000\u0000\u016b\u0169\u0001\u0000\u0000\u0000\u016b"+
		"\u016c\u0001\u0000\u0000\u0000\u016cA\u0001\u0000\u0000\u0000\u016d\u016b"+
		"\u0001\u0000\u0000\u0000\u016e\u0173\u0003D\"\u0000\u016f\u0170\u0007"+
		"\u0001\u0000\u0000\u0170\u0172\u0003D\"\u0000\u0171\u016f\u0001\u0000"+
		"\u0000\u0000\u0172\u0175\u0001\u0000\u0000\u0000\u0173\u0171\u0001\u0000"+
		"\u0000\u0000\u0173\u0174\u0001\u0000\u0000\u0000\u0174C\u0001\u0000\u0000"+
		"\u0000\u0175\u0173\u0001\u0000\u0000\u0000\u0176\u017b\u0003F#\u0000\u0177"+
		"\u0178\u0007\u0002\u0000\u0000\u0178\u017a\u0003F#\u0000\u0179\u0177\u0001"+
		"\u0000\u0000\u0000\u017a\u017d\u0001\u0000\u0000\u0000\u017b\u0179\u0001"+
		"\u0000\u0000\u0000\u017b\u017c\u0001\u0000\u0000\u0000\u017cE\u0001\u0000"+
		"\u0000\u0000\u017d\u017b\u0001\u0000\u0000\u0000\u017e\u0183\u0003H$\u0000"+
		"\u017f\u0180\u0007\u0003\u0000\u0000\u0180\u0182\u0003H$\u0000\u0181\u017f"+
		"\u0001\u0000\u0000\u0000\u0182\u0185\u0001\u0000\u0000\u0000\u0183\u0181"+
		"\u0001\u0000\u0000\u0000\u0183\u0184\u0001\u0000\u0000\u0000\u0184G\u0001"+
		"\u0000\u0000\u0000\u0185\u0183\u0001\u0000\u0000\u0000\u0186\u018b\u0003"+
		"J%\u0000\u0187\u0188\u0007\u0004\u0000\u0000\u0188\u018a\u0003J%\u0000"+
		"\u0189\u0187\u0001\u0000\u0000\u0000\u018a\u018d\u0001\u0000\u0000\u0000"+
		"\u018b\u0189\u0001\u0000\u0000\u0000\u018b\u018c\u0001\u0000\u0000\u0000"+
		"\u018cI\u0001\u0000\u0000\u0000\u018d\u018b\u0001\u0000\u0000\u0000\u018e"+
		"\u0198\u0003L&\u0000\u018f\u0190\u0005\u001a\u0000\u0000\u0190\u0198\u0003"+
		"J%\u0000\u0191\u0192\u0005\u001d\u0000\u0000\u0192\u0198\u0003J%\u0000"+
		"\u0193\u0194\u0005\u001e\u0000\u0000\u0194\u0198\u00056\u0000\u0000\u0195"+
		"\u0196\u0005\u0006\u0000\u0000\u0196\u0198\u0003J%\u0000\u0197\u018e\u0001"+
		"\u0000\u0000\u0000\u0197\u018f\u0001\u0000\u0000\u0000\u0197\u0191\u0001"+
		"\u0000\u0000\u0000\u0197\u0193\u0001\u0000\u0000\u0000\u0197\u0195\u0001"+
		"\u0000\u0000\u0000\u0198K\u0001\u0000\u0000\u0000\u0199\u01be\u00052\u0000"+
		"\u0000\u019a\u01be\u00053\u0000\u0000\u019b\u01be\u00054\u0000\u0000\u019c"+
		"\u01be\u00055\u0000\u0000\u019d\u01be\u0005,\u0000\u0000\u019e\u01be\u0005"+
		"-\u0000\u0000\u019f\u01be\u0005.\u0000\u0000\u01a0\u01a3\u00056\u0000"+
		"\u0000\u01a1\u01a2\u0005\u001f\u0000\u0000\u01a2\u01a4\u00056\u0000\u0000"+
		"\u01a3\u01a1\u0001\u0000\u0000\u0000\u01a3\u01a4\u0001\u0000\u0000\u0000"+
		"\u01a4\u01a5\u0001\u0000\u0000\u0000\u01a5\u01a7\u0005\u0003\u0000\u0000"+
		"\u01a6\u01a8\u0003T*\u0000\u01a7\u01a6\u0001\u0000\u0000\u0000\u01a7\u01a8"+
		"\u0001\u0000\u0000\u0000\u01a8\u01a9\u0001\u0000\u0000\u0000\u01a9\u01be"+
		"\u0005\u0004\u0000\u0000\u01aa\u01af\u00056\u0000\u0000\u01ab\u01ac\u0005"+
		"\u0007\u0000\u0000\u01ac\u01ad\u0003<\u001e\u0000\u01ad\u01ae\u0005\b"+
		"\u0000\u0000\u01ae\u01b0\u0001\u0000\u0000\u0000\u01af\u01ab\u0001\u0000"+
		"\u0000\u0000\u01b0\u01b1\u0001\u0000\u0000\u0000\u01b1\u01af\u0001\u0000"+
		"\u0000\u0000\u01b1\u01b2\u0001\u0000\u0000\u0000\u01b2\u01be\u0001\u0000"+
		"\u0000\u0000\u01b3\u01be\u00056\u0000\u0000\u01b4\u01b5\u0005\u0003\u0000"+
		"\u0000\u01b5\u01b6\u0003<\u001e\u0000\u01b6\u01b7\u0005\u0004\u0000\u0000"+
		"\u01b7\u01be\u0001\u0000\u0000\u0000\u01b8\u01be\u0003N\'\u0000\u01b9"+
		"\u01ba\u0005\u000f\u0000\u0000\u01ba\u01bb\u0003\u0014\n\u0000\u01bb\u01bc"+
		"\u0005\u0010\u0000\u0000\u01bc\u01be\u0001\u0000\u0000\u0000\u01bd\u0199"+
		"\u0001\u0000\u0000\u0000\u01bd\u019a\u0001\u0000\u0000\u0000\u01bd\u019b"+
		"\u0001\u0000\u0000\u0000\u01bd\u019c\u0001\u0000\u0000\u0000\u01bd\u019d"+
		"\u0001\u0000\u0000\u0000\u01bd\u019e\u0001\u0000\u0000\u0000\u01bd\u019f"+
		"\u0001\u0000\u0000\u0000\u01bd\u01a0\u0001\u0000\u0000\u0000\u01bd\u01aa"+
		"\u0001\u0000\u0000\u0000\u01bd\u01b3\u0001\u0000\u0000\u0000\u01bd\u01b4"+
		"\u0001\u0000\u0000\u0000\u01bd\u01b8\u0001\u0000\u0000\u0000\u01bd\u01b9"+
		"\u0001\u0000\u0000\u0000\u01beM\u0001\u0000\u0000\u0000\u01bf\u01c0\u0005"+
		"\u0007\u0000\u0000\u01c0\u01c1\u0003<\u001e\u0000\u01c1\u01c2\u0005\b"+
		"\u0000\u0000\u01c2\u01c3\u0003X,\u0000\u01c3\u01c6\u0005\u000f\u0000\u0000"+
		"\u01c4\u01c7\u0003\u0014\n\u0000\u01c5\u01c7\u0003P(\u0000\u01c6\u01c4"+
		"\u0001\u0000\u0000\u0000\u01c6\u01c5\u0001\u0000\u0000\u0000\u01c6\u01c7"+
		"\u0001\u0000\u0000\u0000\u01c7\u01c8\u0001\u0000\u0000\u0000\u01c8\u01c9"+
		"\u0005\u0010\u0000\u0000\u01c9\u01d4\u0001\u0000\u0000\u0000\u01ca\u01cb"+
		"\u0005\u0007\u0000\u0000\u01cb\u01cc\u0005\b\u0000\u0000\u01cc\u01cd\u0003"+
		"X,\u0000\u01cd\u01cf\u0005\u000f\u0000\u0000\u01ce\u01d0\u0003\u0014\n"+
		"\u0000\u01cf\u01ce\u0001\u0000\u0000\u0000\u01cf\u01d0\u0001\u0000\u0000"+
		"\u0000\u01d0\u01d1\u0001\u0000\u0000\u0000\u01d1\u01d2\u0005\u0010\u0000"+
		"\u0000\u01d2\u01d4\u0001\u0000\u0000\u0000\u01d3\u01bf\u0001\u0000\u0000"+
		"\u0000\u01d3\u01ca\u0001\u0000\u0000\u0000\u01d4O\u0001\u0000\u0000\u0000"+
		"\u01d5\u01da\u0003R)\u0000\u01d6\u01d7\u0005\u0005\u0000\u0000\u01d7\u01d9"+
		"\u0003R)\u0000\u01d8\u01d6\u0001\u0000\u0000\u0000\u01d9\u01dc\u0001\u0000"+
		"\u0000\u0000\u01da\u01d8\u0001\u0000\u0000\u0000\u01da\u01db\u0001\u0000"+
		"\u0000\u0000\u01db\u01de\u0001\u0000\u0000\u0000\u01dc\u01da\u0001\u0000"+
		"\u0000\u0000\u01dd\u01df\u0005\u0005\u0000\u0000\u01de\u01dd\u0001\u0000"+
		"\u0000\u0000\u01de\u01df\u0001\u0000\u0000\u0000\u01dfQ\u0001\u0000\u0000"+
		"\u0000\u01e0\u01e1\u0005\u000f\u0000\u0000\u01e1\u01e3\u0003\u0014\n\u0000"+
		"\u01e2\u01e4\u0005\u0005\u0000\u0000\u01e3\u01e2\u0001\u0000\u0000\u0000"+
		"\u01e3\u01e4\u0001\u0000\u0000\u0000\u01e4\u01e5\u0001\u0000\u0000\u0000"+
		"\u01e5\u01e6\u0005\u0010\u0000\u0000\u01e6S\u0001\u0000\u0000\u0000\u01e7"+
		"\u01ec\u0003V+\u0000\u01e8\u01e9\u0005\u0005\u0000\u0000\u01e9\u01eb\u0003"+
		"V+\u0000\u01ea\u01e8\u0001\u0000\u0000\u0000\u01eb\u01ee\u0001\u0000\u0000"+
		"\u0000\u01ec\u01ea\u0001\u0000\u0000\u0000\u01ec\u01ed\u0001\u0000\u0000"+
		"\u0000\u01edU\u0001\u0000\u0000\u0000\u01ee\u01ec\u0001\u0000\u0000\u0000"+
		"\u01ef\u01f3\u0003<\u001e\u0000\u01f0\u01f1\u0005\u001e\u0000\u0000\u01f1"+
		"\u01f3\u00056\u0000\u0000\u01f2\u01ef\u0001\u0000\u0000\u0000\u01f2\u01f0"+
		"\u0001\u0000\u0000\u0000\u01f3W\u0001\u0000\u0000\u0000\u01f4\u0200\u0005"+
		"6\u0000\u0000\u01f5\u01f6\u0005\u0007\u0000\u0000\u01f6\u01f7\u0003<\u001e"+
		"\u0000\u01f7\u01f8\u0005\b\u0000\u0000\u01f8\u01f9\u0003X,\u0000\u01f9"+
		"\u0200\u0001\u0000\u0000\u0000\u01fa\u01fb\u0005\u0007\u0000\u0000\u01fb"+
		"\u01fc\u0005\b\u0000\u0000\u01fc\u0200\u0003X,\u0000\u01fd\u01fe\u0005"+
		"\u0006\u0000\u0000\u01fe\u0200\u0003X,\u0000\u01ff\u01f4\u0001\u0000\u0000"+
		"\u0000\u01ff\u01f5\u0001\u0000\u0000\u0000\u01ff\u01fa\u0001\u0000\u0000"+
		"\u0000\u01ff\u01fd\u0001\u0000\u0000\u0000\u0200Y\u0001\u0000\u0000\u0000"+
		"2]fr\u0082\u0086\u008d\u0095\u009c\u00a4\u00ab\u00b3\u00bb\u00c9\u00d6"+
		"\u00e0\u00e8\u00f4\u00f9\u0101\u0105\u010f\u0117\u011f\u0126\u0133\u0138"+
		"\u0142\u0147\u014f\u0155\u0163\u016b\u0173\u017b\u0183\u018b\u0197\u01a3"+
		"\u01a7\u01b1\u01bd\u01c6\u01cf\u01d3\u01da\u01de\u01e3\u01ec\u01f2\u01ff";
	public static final ATN _ATN =
		new ATNDeserializer().deserialize(_serializedATN.toCharArray());
	static {
		_decisionToDFA = new DFA[_ATN.getNumberOfDecisions()];
		for (int i = 0; i < _ATN.getNumberOfDecisions(); i++) {
			_decisionToDFA[i] = new DFA(_ATN.getDecisionState(i), i);
		}
	}
}