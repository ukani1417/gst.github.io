

//
CREATE OR REPLACE FUNCTION public.adjust_credit(IN pan character varying)
    RETURNS void
    LANGUAGE 'plpgsql'
    VOLATILE
    PARALLEL UNSAFE
    COST 100
    
AS $BODY$
DECLARE

ic money;  cc money;  sc money;   il money;  cl money;  sl money;

BEGIN

ic = (select igst_credit from credit_leadger where pan_no=pan);
cc = (select cgst_credit from credit_leadger where pan_no=pan);
sc = (select sgst_credit from credit_leadger where pan_no=pan);
il = (select igst_liability from credit_leadger where pan_no=pan);
cl = (select igst_liability from credit_leadger where pan_no=pan);
sl = (select igst_liability from credit_leadger where pan_no=pan);

if ic > il THEN ic = ic-il;  il = 0;    else    il = il-ic;  ic = 0; END IF;
if cc > cl THEN	cc = cc-cl;	il = 0;     else	cl = cl-cc;	cc = 0;END IF;
if sc > sl THEN	sc = sc-sl;	sl = 0;     else	sl = sl-sc;	sc = 0;END IF;

UPDATE credit_leadger
	SET pan_no=pan, igst_credit=ic, cgst_credit=cc, sgst_credit=sc, 
            igst_liability=il, cgst_liability=cl, sgst_liability=sl
	WHERE pan_no = pan;

END
$BODY$;