<?php

/* webview/layout/twig/partials/footer.twig */
class __TwigTemplate_e750bc871773f2127b318ecdcb3c44b382f82506f02ba81e0488601dda2e650f extends Twig_Template
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
        echo "<div class=\"clear\"> </div>
<section class=\"big_footer\">
    <div class=\"container\">
        <div class=\"row\">
\t    <div class=\"col-sm-6 col-md-6 col-lg-3\">
\t        <div class=\"footer-menu\">  
                    <ul>
                       <li><p><b>Winjob</b></p></li>
                       <li><a href=\"";
        // line 9
        echo twig_escape_filter($this->env, site_url("aboutus"), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, app_lang("text_app_about_us"), "html", null, true);
        echo "</a></li>
                       <li><a href=\"";
        // line 10
        echo twig_escape_filter($this->env, site_url("contact"), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, app_lang("text_app_contact_us"), "html", null, true);
        echo "</a></li>
                       <li><a href=\"";
        // line 11
        echo twig_escape_filter($this->env, site_url("press"), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, app_lang("text_app_press"), "html", null, true);
        echo "</a></li>
                       <li><a href=\"";
        // line 12
        echo twig_escape_filter($this->env, site_url("enterprise-solution"), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, app_lang("text_app_enterprise_solution"), "html", null, true);
        echo "</a></li>
                       <li><a href=\"";
        // line 13
        echo twig_escape_filter($this->env, site_url("feedback"), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, app_lang("text_app_feedback"), "html", null, true);
        echo "</a></li>
                   </ul>
\t\t</div>
\t    </div>
            <div class=\"col-sm-6 col-md-6 col-lg-3\">
\t       <div class=\"footer-menu\">  
                    <ul>
                        <li><p><b>";
        // line 20
        echo twig_escape_filter($this->env, app_lang("text_app_contact_support"), "html", null, true);
        echo "</b></p></li>
                        <li><a href=\"";
        // line 21
        echo twig_escape_filter($this->env, site_url("employer-help"), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, app_lang("text_app_help_and_support"), "html", null, true);
        echo "</a></li>
                        <li><a href=\"";
        // line 22
        echo twig_escape_filter($this->env, site_url("trust-safety"), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, app_lang("text_app_trust_and_safety"), "html", null, true);
        echo "</a></li>
                        <li><a href=\"";
        // line 23
        echo twig_escape_filter($this->env, site_url("make-better"), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, app_lang("text_app_help_make_winjob_better"), "html", null, true);
        echo "</a></li>
                    </ul>
\t\t </div>
\t    </div>
            <div class=\"clear1\"></div>
\t    <div class=\"col-sm-6 col-md-6 col-lg-3\">
\t      <div class=\"footer-menu\">  
                    <ul>
                         <li><p><b>";
        // line 31
        echo twig_escape_filter($this->env, app_lang("text_app_informations"), "html", null, true);
        echo "</b></p></li>
                         <li><a href=\"";
        // line 32
        echo twig_escape_filter($this->env, site_url("fees-charges"), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, app_lang("text_app_fee_and_charges"), "html", null, true);
        echo "</a></li>
                         <li><a href=\"";
        // line 33
        echo twig_escape_filter($this->env, site_url("cancellation-refund"), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, app_lang("text_app_cancellations_and_refunds"), "html", null, true);
        echo "</a></li>
                         <li><a href=\"";
        // line 34
        echo twig_escape_filter($this->env, site_url("terms"), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, app_lang("text_app_terms_and_conditions"), "html", null, true);
        echo "</a></li>
                         <li><a href=\"";
        // line 35
        echo twig_escape_filter($this->env, site_url("privacy"), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, app_lang("text_app_privacy_policy"), "html", null, true);
        echo "</a></li>
                         <li><a href=\"";
        // line 36
        echo twig_escape_filter($this->env, site_url("desktop-app"), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, app_lang("text_app_desktop_app"), "html", null, true);
        echo "</a></li>
                    </ul>
\t\t </div>
\t    </div>
            <div class=\"col-sm-6 col-md-6 col-lg-3\">
\t        <div class=\"footer-menu\">  
\t\t    <ul>
\t\t\t<li><p><b>";
        // line 43
        echo twig_escape_filter($this->env, app_lang("text_app_konwledge_base"), "html", null, true);
        echo "</b></p></li>
\t\t\t<li><a href=\"";
        // line 44
        echo twig_escape_filter($this->env, site_url("how-to-join"), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, app_lang("text_app_how_to_join_us"), "html", null, true);
        echo "</a></li>
\t\t\t<li><a href=\"";
        // line 45
        echo twig_escape_filter($this->env, site_url("create-ticket"), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, app_lang("text_app_how_to_create_support_tickets"), "html", null, true);
        echo "</a></li>
\t\t\t<li><a href=\"";
        // line 46
        echo twig_escape_filter($this->env, site_url("getwork-done"), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, app_lang("text_app_how_to_get_your_work_done"), "html", null, true);
        echo "</a></li>
\t\t\t<li><a href=\"";
        // line 47
        echo twig_escape_filter($this->env, site_url("add-fund"), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, app_lang("text_app_how_to_add_fund"), "html", null, true);
        echo "</a></li>
\t            </ul>
\t\t </div>
\t    </div>
        </div>
    </div>
                         
    <div class=\"footer\">
        <div class=\"container\">
            <div class=\"row\">
                <div class=\"col-sm-6 col-md-6\"><h1><b>WINJOB</b></h1></div>
                <div class=\"col-sm-6 col-md-6\"><p>© 2016 WINJOB</p></div>
            </div>
        </div>
    </div>
</section>";
    }

    public function getTemplateName()
    {
        return "webview/layout/twig/partials/footer.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  156 => 47,  150 => 46,  144 => 45,  138 => 44,  134 => 43,  122 => 36,  116 => 35,  110 => 34,  104 => 33,  98 => 32,  94 => 31,  81 => 23,  75 => 22,  69 => 21,  65 => 20,  53 => 13,  47 => 12,  41 => 11,  35 => 10,  29 => 9,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<div class=\"clear\"> </div>
<section class=\"big_footer\">
    <div class=\"container\">
        <div class=\"row\">
\t    <div class=\"col-sm-6 col-md-6 col-lg-3\">
\t        <div class=\"footer-menu\">  
                    <ul>
                       <li><p><b>Winjob</b></p></li>
                       <li><a href=\"{{ site_url(\"aboutus\") }}\">{{ app_lang('text_app_about_us') }}</a></li>
                       <li><a href=\"{{ site_url(\"contact\") }}\">{{ app_lang('text_app_contact_us') }}</a></li>
                       <li><a href=\"{{ site_url(\"press\") }}\">{{ app_lang('text_app_press') }}</a></li>
                       <li><a href=\"{{ site_url(\"enterprise-solution\") }}\">{{ app_lang('text_app_enterprise_solution') }}</a></li>
                       <li><a href=\"{{ site_url(\"feedback\") }}\">{{ app_lang('text_app_feedback') }}</a></li>
                   </ul>
\t\t</div>
\t    </div>
            <div class=\"col-sm-6 col-md-6 col-lg-3\">
\t       <div class=\"footer-menu\">  
                    <ul>
                        <li><p><b>{{ app_lang('text_app_contact_support') }}</b></p></li>
                        <li><a href=\"{{ site_url(\"employer-help\") }}\">{{ app_lang('text_app_help_and_support') }}</a></li>
                        <li><a href=\"{{ site_url(\"trust-safety\") }}\">{{ app_lang('text_app_trust_and_safety') }}</a></li>
                        <li><a href=\"{{ site_url(\"make-better\") }}\">{{ app_lang('text_app_help_make_winjob_better') }}</a></li>
                    </ul>
\t\t </div>
\t    </div>
            <div class=\"clear1\"></div>
\t    <div class=\"col-sm-6 col-md-6 col-lg-3\">
\t      <div class=\"footer-menu\">  
                    <ul>
                         <li><p><b>{{ app_lang('text_app_informations') }}</b></p></li>
                         <li><a href=\"{{ site_url(\"fees-charges\") }}\">{{ app_lang('text_app_fee_and_charges') }}</a></li>
                         <li><a href=\"{{ site_url(\"cancellation-refund\") }}\">{{ app_lang('text_app_cancellations_and_refunds') }}</a></li>
                         <li><a href=\"{{ site_url(\"terms\") }}\">{{ app_lang('text_app_terms_and_conditions') }}</a></li>
                         <li><a href=\"{{ site_url(\"privacy\") }}\">{{ app_lang('text_app_privacy_policy') }}</a></li>
                         <li><a href=\"{{ site_url(\"desktop-app\") }}\">{{ app_lang('text_app_desktop_app') }}</a></li>
                    </ul>
\t\t </div>
\t    </div>
            <div class=\"col-sm-6 col-md-6 col-lg-3\">
\t        <div class=\"footer-menu\">  
\t\t    <ul>
\t\t\t<li><p><b>{{ app_lang('text_app_konwledge_base') }}</b></p></li>
\t\t\t<li><a href=\"{{ site_url(\"how-to-join\") }}\">{{ app_lang('text_app_how_to_join_us') }}</a></li>
\t\t\t<li><a href=\"{{ site_url(\"create-ticket\") }}\">{{ app_lang('text_app_how_to_create_support_tickets') }}</a></li>
\t\t\t<li><a href=\"{{ site_url(\"getwork-done\") }}\">{{ app_lang('text_app_how_to_get_your_work_done') }}</a></li>
\t\t\t<li><a href=\"{{ site_url(\"add-fund\") }}\">{{ app_lang('text_app_how_to_add_fund') }}</a></li>
\t            </ul>
\t\t </div>
\t    </div>
        </div>
    </div>
                         
    <div class=\"footer\">
        <div class=\"container\">
            <div class=\"row\">
                <div class=\"col-sm-6 col-md-6\"><h1><b>WINJOB</b></h1></div>
                <div class=\"col-sm-6 col-md-6\"><p>© 2016 WINJOB</p></div>
            </div>
        </div>
    </div>
</section>", "webview/layout/twig/partials/footer.twig", "C:\\wamp\\www\\winjob\\application\\views\\webview\\layout\\twig\\partials\\footer.twig");
    }
}
