<?php

/* webview/jobs/partials/job-transactions.twig */
class __TwigTemplate_4e97f2cf58d32e1ace7e04d143c94fcd9958c283ef683e4ecf15f40a62fb4c63 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<div class=\"row margin-top margin-top-3\">
    <div class=\"col-md-10 col-md-offset-1\">
        <div class=\"row\">
            <div class=\"fix_view\">
                <div class=\"col-md-7 text-centered text-left\">";
        // line 5
        echo twig_escape_filter($this->env, app_lang("text_job_transaction_description"), "html", null, true);
        echo "</div>
                <div class=\"col-md-2 text-centered text-right\">";
        // line 6
        echo twig_escape_filter($this->env, app_lang("text_job_transaction_amount"), "html", null, true);
        echo "</div>
                <div class=\"col-md-3 text-centered text-center\">";
        // line 7
        echo twig_escape_filter($this->env, app_lang("text_job_transaction_date"), "html", null, true);
        echo "</div>
            </div>
        </div>
        <div class=\"u_border\"></div>
    </div>
</div>

<div class=\"row margin-top-2\">
    <div class=\"col-md-10 col-md-offset-1\">
        <div class=\"row\">
            ";
        // line 17
        if (twig_test_empty((isset($context["payments"]) ? $context["payments"] : null))) {
            // line 18
            echo "                <div style=\"font-size: 14px;\" class=\"col-md-7 text-centered text-left gray-text\">
                    ";
            // line 19
            echo twig_escape_filter($this->env, app_lang("text_job_transaction_empty"), "html", null, true);
            echo "
                </div>
            ";
        } else {
            // line 22
            echo "                ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["payments"]) ? $context["payments"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["payment"]) {
                // line 23
                echo "                    <div style=\"font-size: 14px;\" class=\"col-md-7 text-centered text-left gray-text\">
                    ";
                // line 24
                if (($this->getAttribute($context["payment"], "payment_gross", array()) == $this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "bid_amount", array()))) {
                    // line 25
                    echo "                        ";
                    echo twig_escape_filter($this->env, app_lang("text_job_transaction_paid_all"), "html", null, true);
                    echo "
                    ";
                } elseif ((($this->getAttribute(                // line 26
$context["payment"], "payment_gross", array()) < $this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "bid_amount", array())) || ($this->getAttribute($context["payment"], "payment_gross", array()) > $this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "bid_amount", array())))) {
                    // line 27
                    echo "                        ";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["payment"], "des", array()), "html", null, true);
                    echo "
                    ";
                } elseif (($this->getAttribute(                // line 28
$context["payment"], "payment_gross", array()) == 0)) {
                    // line 29
                    echo "                        ";
                    echo twig_escape_filter($this->env, app_lang("text_job_transaction_paid_nothing"), "html", null, true);
                    echo "
                    ";
                }
                // line 31
                echo "                    </div>
                    <div style=\"font-size: 14px;\" class=\"col-md-2 text-centered text-right gray-text\">\$";
                // line 32
                echo twig_escape_filter($this->env, $this->getAttribute($context["payment"], "payment_gross", array()), "html", null, true);
                echo "</div>
                    <div style=\"font-size: 14px;\" class=\"col-md-3 text-centered text-center gray-text\">
                        ";
                // line 34
                echo twig_escape_filter($this->env, app_date($this->getAttribute($context["payment"], "payment_create", array()), " M j, Y "), "html", null, true);
                echo "
                    </div>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['payment'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 37
            echo "            ";
        }
        // line 38
        echo "        </div>
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "webview/jobs/partials/job-transactions.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  107 => 38,  104 => 37,  95 => 34,  90 => 32,  87 => 31,  81 => 29,  79 => 28,  74 => 27,  72 => 26,  67 => 25,  65 => 24,  62 => 23,  57 => 22,  51 => 19,  48 => 18,  46 => 17,  33 => 7,  29 => 6,  25 => 5,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<div class=\"row margin-top margin-top-3\">
    <div class=\"col-md-10 col-md-offset-1\">
        <div class=\"row\">
            <div class=\"fix_view\">
                <div class=\"col-md-7 text-centered text-left\">{{ app_lang('text_job_transaction_description') }}</div>
                <div class=\"col-md-2 text-centered text-right\">{{ app_lang('text_job_transaction_amount') }}</div>
                <div class=\"col-md-3 text-centered text-center\">{{ app_lang('text_job_transaction_date') }}</div>
            </div>
        </div>
        <div class=\"u_border\"></div>
    </div>
</div>

<div class=\"row margin-top-2\">
    <div class=\"col-md-10 col-md-offset-1\">
        <div class=\"row\">
            {% if payments is empty %}
                <div style=\"font-size: 14px;\" class=\"col-md-7 text-centered text-left gray-text\">
                    {{ app_lang('text_job_transaction_empty') }}
                </div>
            {% else %}
                {% for payment in payments %}
                    <div style=\"font-size: 14px;\" class=\"col-md-7 text-centered text-left gray-text\">
                    {% if payment.payment_gross == job_status.bid_amount %}
                        {{ app_lang('text_job_transaction_paid_all') }}
                    {% elseif payment.payment_gross < job_status.bid_amount or payment.payment_gross > job_status.bid_amount %}
                        {{ payment.des  }}
                    {% elseif payment.payment_gross == 0 %}
                        {{ app_lang('text_job_transaction_paid_nothing') }}
                    {% endif %}
                    </div>
                    <div style=\"font-size: 14px;\" class=\"col-md-2 text-centered text-right gray-text\">\${{ payment.payment_gross }}</div>
                    <div style=\"font-size: 14px;\" class=\"col-md-3 text-centered text-center gray-text\">
                        {{ app_date( payment.payment_create, ' M j, Y ') }}
                    </div>
                {% endfor %}
            {% endif %}
        </div>
    </div>
</div>", "webview/jobs/partials/job-transactions.twig", "C:\\wamp\\www\\winjob\\application\\views\\webview\\jobs\\partials\\job-transactions.twig");
    }
}
