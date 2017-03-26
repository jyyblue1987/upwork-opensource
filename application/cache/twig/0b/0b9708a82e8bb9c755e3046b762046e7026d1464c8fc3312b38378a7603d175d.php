<?php

/* webview/modals/milestone-modal.twig */
class __TwigTemplate_c9bdb04ab2d073e5dcc29b78fa6bde5c147b74ab1d246752d6261a9c56196f5f extends Twig_Template
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
        echo "<div id=\"edit-milestone\" class=\"modal fade payment-modal\" tabindex=\"-1\" role=\"dialog\">
  <div class=\"modal-dialog\" role=\"document\">
    <div class=\"modal-content\">
        <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
            <span aria-hidden=\"true\">&times;</span>
        </button>
        ";
        // line 8
        echo "        <div class=\"modal-header\">
            <h4 class=\"text-center\">Release Milestone funds - <span></span></h4>
        </div>
        ";
        // line 12
        echo "        <div class=\"modal-body\" id=\"milestone-details-modal\">
            <div class=\"result-msg alert hide  fade in \">
                <a href=\"#\" class=\"close\" aria-label=\"close\" title=\"close\">×</a>
                <span class='content'></span>
            </div>
            <form method=\"post\" id=\"hr_addMilestone\" action=\"";
        // line 17
        echo twig_escape_filter($this->env, site_url("pay/contract"), "html", null, true);
        echo "\" class=\"form-inline\">
                <div class=\"text-center input-content\">
                    <label for=\"amount\">
                        Milestone <span style=\"margin-left: 15px;font-size: 17px;\">\$</span>
                    </label>
                    <input  class=\"form-control amount\" type=\"text\" name=\"amount\" value=\"\" />
                </div>
                <div class=\"text-center btn-container\">
                    <button id=\"hr_btnpay\" class=\"btn-primary big_mass_active transparent-btn \">
                        Pay Now
                        <i class=\"fa fa-circle-o-notch hide form-loader\"></i>
                    </button>
                    <a class=\"btn-primary big_mass_active transparent-btn \" class=\"close\" data-dismiss=\"modal\">cancel</a>
                </div>
            </form>
        </div>
    </div>
  </div>
</div>

";
    }

    public function getTemplateName()
    {
        return "webview/modals/milestone-modal.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  39 => 17,  32 => 12,  27 => 8,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<div id=\"edit-milestone\" class=\"modal fade payment-modal\" tabindex=\"-1\" role=\"dialog\">
  <div class=\"modal-dialog\" role=\"document\">
    <div class=\"modal-content\">
        <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
            <span aria-hidden=\"true\">&times;</span>
        </button>
        {# header #}
        <div class=\"modal-header\">
            <h4 class=\"text-center\">Release Milestone funds - <span></span></h4>
        </div>
        {# body #}
        <div class=\"modal-body\" id=\"milestone-details-modal\">
            <div class=\"result-msg alert hide  fade in \">
                <a href=\"#\" class=\"close\" aria-label=\"close\" title=\"close\">×</a>
                <span class='content'></span>
            </div>
            <form method=\"post\" id=\"hr_addMilestone\" action=\"{{ site_url(\"pay/contract\") }}\" class=\"form-inline\">
                <div class=\"text-center input-content\">
                    <label for=\"amount\">
                        Milestone <span style=\"margin-left: 15px;font-size: 17px;\">\$</span>
                    </label>
                    <input  class=\"form-control amount\" type=\"text\" name=\"amount\" value=\"\" />
                </div>
                <div class=\"text-center btn-container\">
                    <button id=\"hr_btnpay\" class=\"btn-primary big_mass_active transparent-btn \">
                        Pay Now
                        <i class=\"fa fa-circle-o-notch hide form-loader\"></i>
                    </button>
                    <a class=\"btn-primary big_mass_active transparent-btn \" class=\"close\" data-dismiss=\"modal\">cancel</a>
                </div>
            </form>
        </div>
    </div>
  </div>
</div>

", "webview/modals/milestone-modal.twig", "C:\\wamp\\www\\winjob\\application\\views\\webview\\modals\\milestone-modal.twig");
    }
}
