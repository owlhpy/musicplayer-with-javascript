using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Windows.Forms;

namespace 计算器
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
        }

        string str = "";
       

        private int changechar(char e)
        {
            int b = Convert.ToInt32(e);
            return b;
        }

        Stack<char> opt = new Stack<char>();
        Stack<int> num = new Stack<int>();
        public void choosek(Stack<char> opt, Stack<int> num)
        {
            char a;
            int f = 0, s = 0, result = 0;
            while (opt.Peek() != '(')
            {
                a = opt.Peek();
                if (a == '+')
                {
                    s = num.Pop();
                    f = num.Pop();
                    result = f + s;
                    opt.Pop();
                    num.Push(result);

                }
                else if (a == '-')
                {
                    s = num.Pop();
                    f = num.Pop();
                    result = f - s;
                    opt.Pop();
                    num.Push(result);
                }
                else if (a == '*')
                {
                    s = num.Pop();
                    f = num.Pop();
                    result = f * s;
                    opt.Pop();
                    num.Push(result);
                }
                else
                {
                    s = num.Pop();
                    f = num.Pop();
                    result = f / s;
                    opt.Pop();
                    num.Push(result);

                }
            }
            opt.Pop();
        }


        public void choose(Stack<char> opt, Stack<int> num)
        {
            char a;
            int f = 0, s = 0, result = 0;
            while (opt.Count != 0)
            {
                a = opt.Peek();
                if (a == '+')
                {
                    s = num.Pop();
                    f = num.Pop();
                    result = f + s;
                    opt.Pop();
                    num.Push(result);

                }
                else if (a == '-')
                {
                    s = num.Pop();
                    f = num.Pop();
                    result = f - s;
                    opt.Pop();
                    num.Push(result);
                }
                else if (a == '*')
                {
                    s = num.Pop();
                    f = num.Pop();
                    result = f * s;
                    opt.Pop();
                    num.Push(result);
                }
                else
                {
                    s = num.Pop();
                    f = num.Pop();
                    result = f / s;
                    opt.Pop();
                    num.Push(result);

                }
            }
        }
        public string judgenum(string e, int i, ref int nums)
        {
            int count = 0, k = i;
            if (i == e.Length - 1)
            {
                nums = 1;
                return e.Substring(i, 1);
            }
            string a;
            do
            {
                count++;
                i++;
                if (i == e.Length)
                    break;
            } while ((e[i] != '+') && (e[i] != '-') && (e[i] != '*') && (e[i] != '/') && (e[i] != '(') && (e[i] != ')'));
            nums = count;
            a = e.Substring(k, count);
            return a;

        }


        private void button15_Click(object sender, EventArgs e)
        {

            char a, b;
            int result = 0, f = 0, s = 0, last = 0, nums = 1;
            for (int i = 0; i < str.Length; i += nums)
            {

                b = str[i];
                if (opt.Count == 0 && (b == '*' || b == '/' || b == '-' || b == '+'))
                {
                    opt.Push(str[i]);
                    nums = 1;
                }
                else if (opt.Count != 0 && (b == '*' || b == '/' || b == '-' || b == '+'))
                {
                    nums = 1;
                    a = opt.Peek();
                    switch (b)
                    {
                        case '*':
                        case '/':
                            {
                                if (a == '-' || a == '+')
                                    opt.Push(b);
                                else if (a == '*')
                                {
                                    s = num.Pop();
                                    f = num.Pop();
                                    result = f * s;
                                    opt.Pop();
                                    num.Push(result);
                                    opt.Push(b);

                                }
                                else if (a == '(')
                                {
                                    opt.Push(b);
                                }
                                else
                                {
                                    s = num.Pop();
                                    f = num.Pop();
                                    result = f / s;
                                    opt.Pop();
                                    num.Push(result);
                                    opt.Push(b);

                                }

                            } break;
                        case '+':
                        case '-':
                            {
                                if (a == '*')
                                {
                                    s = num.Pop();
                                    f = num.Pop();
                                    result = f * s;
                                    opt.Pop();
                                    num.Push(result);
                                    opt.Push(b);
                                }
                                else if (a == '/')
                                {
                                    s = num.Pop();
                                    f = num.Pop();
                                    result = f / s;
                                    opt.Pop();
                                    num.Push(result);
                                    opt.Push(b);
                                }
                                else if (a == '-')
                                {
                                    s = num.Pop();
                                    f = num.Pop();
                                    result = f - s;
                                    opt.Pop();
                                    num.Push(result);
                                    opt.Push(b);
                                }
                                else if (a == '(')
                                {
                                    opt.Push(b);
                                }
                                else
                                {
                                    s = num.Pop();
                                    f = num.Pop();
                                    result = f + s;
                                    opt.Pop();
                                    num.Push(result);
                                    opt.Push(b);
                                }
                            } break;

                    }
                }
                else if (b == '(')
                {
                    nums = 1;
                    opt.Push(b);
                }
                else if (b == ')')
                {
                    choosek(opt, num);
                }
                else
                {

                    num.Push(Convert.ToInt32(judgenum(str, i, ref nums)));
                }

            }
            if (opt.Count != 0)
            {
                choose(opt, num);
            }
            last = num.Pop();
            textBox1.Text = Convert.ToString(last);




        }

        private void button17_Click(object sender, EventArgs e)
        {
            str += button17.Text;
            textBox1.Text = str;
        }

        private void button18_Click(object sender, EventArgs e)
        {
            str += button18.Text;
            textBox1.Text = str;
        }


        private void textBox1_TextChanged(object sender, EventArgs e)
        {

        }

        private void button1_Click_1(object sender, EventArgs e)
        {
            str += button1.Text;
            textBox1.Text = str;
        }

        private void button2_Click_1(object sender, EventArgs e)
        {
            str += button2.Text;
            textBox1.Text = str;
        }

        private void button3_Click(object sender, EventArgs e)
        {
            str += button3.Text;
            textBox1.Text = str;
        }

        private void button4_Click_1(object sender, EventArgs e)
        {
            str += button4.Text;
            textBox1.Text = str;
        }

        private void button5_Click_1(object sender, EventArgs e)
        {
            str += button5.Text;
            textBox1.Text = str;
        }

        private void button6_Click_1(object sender, EventArgs e)
        {
            str += button6.Text;
            textBox1.Text = str;
        }

        private void button7_Click_1(object sender, EventArgs e)
        {
            str += button7.Text;
            textBox1.Text = str;
        }

        private void button8_Click_1(object sender, EventArgs e)
        {
            str += button8.Text;
            textBox1.Text = str;
        }

        private void button9_Click_1(object sender, EventArgs e)
        {
            str += button9.Text;
            textBox1.Text = str;
        }

        private void button16_Click_1(object sender, EventArgs e)
        {
            str += button16.Text;
            textBox1.Text = str;
        }

        private void button17_Click_1(object sender, EventArgs e)
        {
            str += button17.Text;
            textBox1.Text = str;
        }

        private void button18_Click_1(object sender, EventArgs e)
        {
            str += button18.Text;
            textBox1.Text = str;
        }

        private void button10_Click_1(object sender, EventArgs e)
        {
            str += button10.Text;
            textBox1.Text = str;
        }

        private void button11_Click_1(object sender, EventArgs e)
        {
            str += button11.Text;
            textBox1.Text = str;
        }

        private void button12_Click_1(object sender, EventArgs e)
        {
            str += button12.Text;
            textBox1.Text = str;
        }

        private void button13_Click_1(object sender, EventArgs e)
        {
            str += button13.Text;
            textBox1.Text = str;
        }

        private void button14_Click(object sender, EventArgs e)
        {
            str = "";
            textBox1.Text = str;
        }

    

      
    }
}
