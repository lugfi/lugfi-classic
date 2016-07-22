module ctbf;

import std.cstream;
import std.stdio;

static char[] ctbf(char[] bf)
{

	char[] code = "
byte[] mem;
uint memptr = 0;
mem.length = 1;
void expand()
{
	if (mem.length <= memptr)
	{
		mem.length = memptr + 1;
	}
}
";

	char[] tab = "";

	foreach (c; bf)
	{
		switch (c)
		{
			case '>':
				code ~= tab ~ "memptr++; expand();\n";
				break;

			case '<':
				code ~= tab ~ "memptr--;\n";
				break;

			case '+':
				code ~= tab ~ "mem[memptr]++;\n";
				break;

			case '-':
				code ~= tab ~ "mem[memptr]--;\n";
				break;

			case '[':
				code ~= tab ~ "while (mem[memptr])\n{\n";
				tab = "\t";
				break;

			case ']':
				tab = "";
				code ~= tab ~ "}\n";
				break;

			case '.':
				code ~= tab ~ "dout.write(cast(char) mem[memptr]);\n";
				break;

			case ',':
				code ~= tab ~ "din.read(mem[memptr]);\n";
				break;

			default:
		}
	}

	return code;
}

int main(char[][] args)
{
	if (args.length > 1 && args[1] == "-v")
		writefln(ctbf(import("helloworld.bf")));
	mixin(ctbf(import("helloworld.bf")));
	return 0;
}

